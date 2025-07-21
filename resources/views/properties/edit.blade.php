@extends('layouts.app')

@section('title', 'تعديل العقار')

@section('content')
<div class="container">
    <div class="form-container">
        <h2>تعديل العقار: {{ $property->title }}</h2>
        
        <form method="POST" action="{{ route('properties.update', $property->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-row">
                <div class="form-group">
                    <label for="title">عنوان العقار:</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $property->title) }}" required>
                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price">السعر (جنيه):</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $property->price) }}" required>
                    @error('price')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="location">الموقع:</label>
                    <input type="text" id="location" name="location" value="{{ old('location', $property->location) }}" required>
                    @error('location')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="type">نوع العقار:</label>
                    <select id="type" name="type" required>
                        <option value="">اختر النوع</option>
                        <option value="شقة" {{ old('type', $property->type) === 'شقة' ? 'selected' : '' }}>شقة</option>
                        <option value="منزل" {{ old('type', $property->type) === 'منزل' ? 'selected' : '' }}>منزل</option>
                        <option value="فيلا" {{ old('type', $property->type) === 'فيلا' ? 'selected' : '' }}>فيلا</option>
                        <option value="محل" {{ old('type', $property->type) === 'محل' ? 'selected' : '' }}>محل</option>
                    </select>
                    @error('type')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="listing_type">نوع العرض:</label>
                    <select id="listing_type" name="listing_type" required>
                        <option value="">اختر النوع</option>
                        <option value="إيجار" {{ old('listing_type', $property->listing_type) === 'إيجار' ? 'selected' : '' }}>إيجار</option>
                        <option value="بيع" {{ old('listing_type', $property->listing_type) === 'بيع' ? 'selected' : '' }}>بيع</option>
                    </select>
                    @error('listing_type')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">حالة العقار:</label>
                    <select id="status" name="status" required>
                        <option value="متاح" {{ old('status', $property->status) === 'متاح' ? 'selected' : '' }}>متاح</option>
                        <option value="مؤجر" {{ old('status', $property->status) === 'مؤجر' ? 'selected' : '' }}>مؤجر</option>
                        <option value="مباع" {{ old('status', $property->status) === 'مباع' ? 'selected' : '' }}>مباع</option>
                    </select>
                    @error('status')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="contact_phone">رقم التواصل:</label>
                    <input type="text" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $property->contact_phone) }}" required>
                    @error('contact_phone')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="rooms">عدد الغرف:</label>
                    <input type="number" id="rooms" name="rooms" value="{{ old('rooms', $property->rooms) }}" min="1" required>
                    @error('rooms')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="bathrooms">عدد الحمامات:</label>
                    <input type="number" id="bathrooms" name="bathrooms" value="{{ old('bathrooms', $property->bathrooms) }}" min="1" required>
                    @error('bathrooms')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="size">المساحة (م²):</label>
                    <input type="number" id="size" name="size" value="{{ old('size', $property->size) }}" min="1" required>
                    @error('size')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description">الوصف:</label>
                <textarea id="description" name="description" rows="5" required>{{ old('description', $property->description) }}</textarea>
                @error('description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Current Images Section -->
            @if($property->images && count($property->images) > 0)
                <div class="form-group">
                    <label>الصور الحالية:</label>
                    <div class="current-images">
                        @foreach($property->images as $index => $image)
                            <div class="current-image-item">
                                <img src="{{ asset($image) }}" alt="صورة العقار">
                                <div class="image-controls">
                                    <input type="checkbox" name="remove_images[]" value="{{ $index }}" id="remove_{{ $index }}">
                                    <label for="remove_{{ $index }}">حذف هذه الصورة</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Add New Images Section -->
            <div class="form-group">
                <label for="images">
                    @if($property->images && count($property->images) > 0)
                        إضافة صور جديدة:
                    @else
                        صور العقار (اختر من 3-5 صور):
                    @endif
                </label>
                <input type="file" id="images" name="images[]" multiple accept="image/*">
                <small class="form-hint">يمكنك إضافة صور جديدة أو استبدال الصور الحالية</small>
                @error('images.*')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">تحديث العقار</button>
                <a href="{{ route('properties.show', $property->id) }}" class="btn btn-secondary">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection
