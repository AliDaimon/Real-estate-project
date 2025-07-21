@extends('layouts.app')

@section('title', 'العقارات المتاحة')

@section('content')
<div class="container">
    <div class="page-header">
        <h1>العقارات المتاحة</h1>
        @auth
            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'renter')
                <a href="{{ route('properties.create') }}" class="btn btn-primary">إضافة عقار جديد</a>
            @endif
        @endauth
    </div>

    <div class="properties-grid">
        @forelse($properties as $property)
            <div class="property-card">
                <div class="property-image">
                    @if($property->images && count($property->images) > 0)
                        <img src="{{ asset($property->images[0]) }}" alt="{{ $property->title }}">
                    @else
                        <div class="no-image">لا توجد صورة</div>
                    @endif
                    <div class="property-status status-{{ $property->status }}">
                        {{ $property->status }}
                    </div>
                </div>
                
                <div class="property-info">
                    <h3>{{ $property->title }}</h3>
                    <p class="price">{{ number_format($property->price) }} جنيه</p>
                    <p class="location">📍 {{ $property->location }}</p>
                    <p class="type">{{ $property->type }} • {{ $property->listing_type }}</p>
                    
                    <div class="property-features">
                        <span>🛏️ {{ $property->rooms }} غرف</span>
                        <span>🚿 {{ $property->bathrooms }} حمام</span>
                        <span>📐 {{ $property->size }} م²</span>
                    </div>
                    
                    <div class="property-actions">
                        <a href="{{ route('properties.show', $property->id) }}" class="btn btn-outline">التفاصيل</a>
                        
                        @auth
                            {{-- Admin can edit/delete any property --}}
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-secondary">تعديل</a>
                                <form action="{{ route('properties.destroy', $property->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من حذف العقار؟')">حذف</button>
                                </form>
                            @endif

                            {{-- Renter can edit/delete only their own properties --}}
                            @if(auth()->user()->role === 'renter' && $property->user_id === auth()->id())
                                <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-secondary">تعديل</a>
                                <form action="{{ route('properties.destroy', $property->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من حذف العقار؟')">حذف</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="no-properties">
                <p>لا توجد عقارات متاحة حالياً</p>
            </div>
        @endforelse
    </div>

    <div class="pagination-wrapper">
        {{ $properties->links() }}
    </div>
</div>
@endsection
