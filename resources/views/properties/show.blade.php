
@extends('layouts.app')

@section('title', $property->title)

@section('content')
<div class="container">
    <div class="property-detail">
        <div class="property-images">
            @if($property->images && count($property->images) > 0)
                <div class="main-image">
                    <img src="{{ asset($property->images[0]) }}" alt="{{ $property->title }}" id="mainImage">
                </div>
                @if(count($property->images) > 1)
                    <div class="thumbnail-images">
                        @foreach($property->images as $index => $image)
                            <img src="{{ asset($image) }}" alt="{{ $property->title }}"
                                 onclick="changeImage('{{ asset($image) }}')"
                                 class="thumbnail {{ $index === 0 ? 'active' : '' }}">
                        @endforeach
                    </div>
                @endif
            @else
                <div class="no-image-large">لا توجد صور لهذا العقار</div>
            @endif
        </div>

        <div class="property-details">
            <div class="property-header">
                <h1>{{ $property->title }}</h1>
                <div class="property-status status-{{ $property->status }}">
                    {{ $property->status }}
                </div>
            </div>

            <div class="property-price">
                <span class="price">{{ number_format($property->price) }} جنيه</span>
                <span class="listing-type">{{ $property->listing_type }}</span>
            </div>

            <div class="property-info-grid">
                <div class="info-item">
                    <strong>الموقع:</strong>
                    <span>{{ $property->location }}</span>
                </div>
                <div class="info-item">
                    <strong>النوع:</strong>
                    <span>{{ $property->type }}</span>
                </div>
                <div class="info-item">
                    <strong>عدد الغرف:</strong>
                    <span>{{ $property->rooms }}</span>
                </div>
                <div class="info-item">
                    <strong>عدد الحمامات:</strong>
                    <span>{{ $property->bathrooms }}</span>
                </div>
                <div class="info-item">
                    <strong>المساحة:</strong>
                    <span>{{ $property->size }} متر مربع</span>
                </div>
                <div class="info-item">
                    <strong>رقم التواصل:</strong>
                    <span>{{ $property->contact_phone }}</span>
                </div>
            </div>

            <div class="property-description">
                <h3>الوصف:</h3>
                <p>{{ $property->description }}</p>
            </div>

            <div class="property-actions">
                @auth
                    @if($property->status === 'متاح')
                        <form action="{{ route('properties.confirm', $property->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary" onclick="return confirm('هل أنت متأكد من تأكيد هذه المعاملة؟')">
                                تأكيد {{ $property->listing_type === 'إيجار' ? 'الإيجار' : 'الشراء' }}
                            </button>
                        </form>
                    @endif

                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-secondary">تعديل العقار</a>
                        <form action="{{ route('properties.destroy', $property->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذا العقار؟')">
                                حذف العقار
                            </button>
                        </form>
                    @endif
                @else
                    <p class="auth-notice">
                        <a href="{{ route('login') }}">سجل دخولك</a> لتتمكن من تأكيد المعاملة
                    </p>
                @endauth
            </div>
        </div>
    </div>
</div>

<script>
function changeImage(src) {
    document.getElementById('mainImage').src = src;
    document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
    event.target.classList.add('active');
}
</script>
@endsection
