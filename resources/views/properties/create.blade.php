@extends('layouts.app')

@section('title', 'إضافة عقار جديد')

@section('content')
<div class="container">
    <div class="form-container">
        <h2>إضافة عقار جديد</h2>
        
        <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="form-row">
                <div class="form-group">
                    <label for="title">عنوان العقار:</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price">السعر (ريال):</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" required>
                    @error('price')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="location">الموقع:</label>
                    <input type="text" id="location" name="location" value="{{ old('location') }}" required>
                    @error('location')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="type">نوع العقار:</label>
                    <select id="type" name="type" required>
                        <option value="">اختر النوع</option>
                        <option value="شقة" {{ old('type') === 'شقة' ? 'selected' : '' }}>شقة</option>
                        <option value="منزل" {{ old('type') === 'منزل' ? 'selected' : '' }}>منزل</option>
                        <option value="فيلا" {{ old('type') === 'فيلا' ? 'selected' : '' }}>فيلا</option>
                        <option value="محل" {{ old('type') === 'محل' ? 'selected' : '' }}>محل</option>
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
                        <option value="إيجار" {{ old('listing_type') === 'إيجار' ? 'selected' : '' }}>إيجار</option>
                        <option value="بيع" {{ old('listing_type') === 'بيع' ? 'selected' : '' }}>بيع</option>
                    </select>
                    @error('listing_type')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="contact_phone">رقم التواصل:</label>
                    <input type="text" id="contact_phone" name="contact_phone" value="{{ old('contact_phone') }}" required>
                    @error('contact_phone')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="rooms">عدد الغرف:</label>
                    <input type="number" id="rooms" name="rooms" value="{{ old('rooms') }}" min="1" required>
                    @error('rooms')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="bathrooms">عدد الحمامات:</label>
                    <input type="number" id="bathrooms" name="bathrooms" value="{{ old('bathrooms') }}" min="1" required>
                    @error('bathrooms')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="size">المساحة (م²):</label>
                    <input type="number" id="size" name="size" value="{{ old('size') }}" min="1" required>
                    @error('size')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description">الوصف:</label>
                <textarea id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                @error('description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="images">صور العقار (اختر من 3-5 صور):</label>
                <input type="file" id="images" name="images[]" multiple accept="image/*">
                @error('images.*')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">إضافة العقار</button>
                <a href="{{ route('properties.index') }}" class="btn btn-secondary">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection