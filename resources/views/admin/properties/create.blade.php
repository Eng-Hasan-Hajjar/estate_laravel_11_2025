@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Add New Property</h1>

    <!-- عرض الأخطاء العامة في أعلى النموذج -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some problems with your input:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- حقل العنوان -->
        <div class="mb-3">
            <label for="title" class="form-label">Property Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- حقل الموقع -->
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}" required>
            @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- حقل السعر -->
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" step="0.01" required>
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- حقل النوع -->
        <div class="mb-3">
            <label for="property_type_id" class="form-label">Property Type</label>
            <select name="property_type_id" id="property_type_id" class="form-select @error('property_type_id') is-invalid @enderror" required>
                <option value="">Select Property Type</option>
                @foreach($propertyTypes as $propertyType)
                    <option value="{{ $propertyType->id }}" {{ old('property_type_id') == $propertyType->id ? 'selected' : '' }}>
                        {{ $propertyType->name }}
                    </option>
                @endforeach
            </select>
            @error('property_type_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- حقل المساحة -->
        <div class="mb-3">
            <label for="area" class="form-label">Area (sq. ft.)</label>
            <input type="number" name="area" id="area" class="form-control @error('area') is-invalid @enderror" value="{{ old('area') }}" required>
            @error('area')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- حقل عدد غرف النوم -->
        <div class="mb-3">
            <label for="num_bedrooms" class="form-label">Number of Bedrooms</label>
            <input type="number" name="num_bedrooms" id="num_bedrooms" class="form-control @error('num_bedrooms') is-invalid @enderror" value="{{ old('num_bedrooms') }}" required>
            @error('num_bedrooms')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- حقل عدد الحمامات -->
        <div class="mb-3">
            <label for="num_bathrooms" class="form-label">Number of Bathrooms</label>
            <input type="number" name="num_bathrooms" id="num_bathrooms" class="form-control @error('num_bathrooms') is-invalid @enderror" value="{{ old('num_bathrooms') }}" required>
            @error('num_bathrooms')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- حقل الحالة -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                <option value="rented" {{ old('status') == 'rented' ? 'selected' : '' }}>Rented</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- حقل الوصف -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- حقل الصورة الرئيسية -->
        <div class="mb-3">
            <label for="main_image" class="form-label">Main Image</label>
            <input type="file" name="main_image" id="main_image" class="form-control @error('main_image') is-invalid @enderror" accept="image/*">
            @error('main_image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Property</button>
    </form>
</div>
@endsection
