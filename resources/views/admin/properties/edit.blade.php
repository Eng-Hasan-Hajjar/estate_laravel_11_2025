@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Edit Property: {{ $property->title }}</h1>

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

    <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- حقل العنوان -->
        <div class="mb-3">
            <label for="title" class="form-label">Property Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $property->title) }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- حقل الموقع -->
  
        <div class="mb-3">
            <label for="location_id" class="form-label"> Location</label>
            <select name="location_id" id="location_id" class="form-select @error('location') is-invalid @enderror" required>
                <option value="">Select Location </option>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}" {{ old('location') == $location->id ? 'selected' : '' }}>
                        {{ $location->name }}
                    </option>
                @endforeach
            </select>
                @error('location')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
        </div>

        <!-- حقل السعر -->
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $property->price) }}" step="0.01" required>
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="currency" class="form-label">Currency</label>
            <select name="currency" id="currency" class="form-select @error('currency') is-invalid @enderror" required>
                <option value="SYP" {{ old('currency', $property->currency ?? 'USD') == 'SYP' ? 'selected' : '' }}>ليرة سورية   (SYP)</option>

                <option value="USD" {{ old('currency', $property->currency ?? 'USD') == 'USD' ? 'selected' : '' }}>دولار أمريكي (USD)</option>
                <option value="EUR" {{ old('currency', $property->currency ?? 'USD') == 'EUR' ? 'selected' : '' }}>يورو (EUR)</option>
                <option value="SAR" {{ old('currency', $property->currency ?? 'USD') == 'SAR' ? 'selected' : '' }}>ريال سعودي (SAR)</option>
                <option value="AED" {{ old('currency', $property->currency ?? 'USD') == 'AED' ? 'selected' : '' }}>درهم إماراتي (AED)</option>
            </select>
            @error('currency')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        

        <!-- حقل النوع -->
        <div class="mb-3">
            <label for="property_type_id" class="form-label">Property Type</label>
            <select name="property_type_id" id="property_type_id" class="form-select @error('property_type_id') is-invalid @enderror" required>
                <option value="">Select Property Type</option>
                @foreach($propertyTypes as $propertyType)
                    <option value="{{ $propertyType->id }}" {{ $property->property_type_id == $propertyType->id ? 'selected' : '' }}>
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
            <input type="number" name="area" id="area" class="form-control @error('area') is-invalid @enderror" value="{{ old('area', $property->area) }}" required>
            @error('area')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
      
        
        <div class="mb-3">
            <label for="directions" class="form-label">Directions </label>
            <select name="directions[]" id="directions" class="form-select" multiple>
                <option value="north" {{ in_array('north', old('directions', explode(',', $property->directions ?? ''))) ? 'selected' : '' }}>North</option>
                <option value="south" {{ in_array('south', old('directions', explode(',', $property->directions ?? ''))) ? 'selected' : '' }}>South</option>
                <option value="east" {{ in_array('east', old('directions', explode(',', $property->directions ?? ''))) ? 'selected' : '' }}>East</option>
                <option value="west" {{ in_array('west', old('directions', explode(',', $property->directions ?? ''))) ? 'selected' : '' }}>West</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="num_balconies" class="form-label">Num of balconies </label>
            <input type="number" name="num_balconies" id="num_balconies" class="form-control" value="{{ old('num_balconies', $property->num_balconies ?? 0) }}" min="0">
        </div>
        <div class="mb-3">
            <label class="form-label">  Is the property furnished?  </label>
            <div>
                <input type="radio" name="is_furnished" value="1" {{ old('is_furnished', $property->is_furnished ?? 0) == 1 ? 'checked' : '' }}> yes
                <input type="radio" name="is_furnished" value="0" {{ old('is_furnished', $property->is_furnished ?? 0) == 0 ? 'checked' : '' }}> no
            </div>
        </div>
        
        <!-- حقل عدد غرف النوم -->
        <div class="mb-3">
            <label for="num_bedrooms" class="form-label">Number of Bedrooms</label>
            <input type="number" name="num_bedrooms" id="num_bedrooms" class="form-control @error('num_bedrooms') is-invalid @enderror" value="{{ old('num_bedrooms', $property->num_bedrooms) }}" required>
            @error('num_bedrooms')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- حقل عدد الحمامات -->
        <div class="mb-3">
            <label for="num_bathrooms" class="form-label">Number of Bathrooms</label>
            <input type="number" name="num_bathrooms" id="num_bathrooms" class="form-control @error('num_bathrooms') is-invalid @enderror" value="{{ old('num_bathrooms', $property->num_bathrooms) }}" required>
            @error('num_bathrooms')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- حقل الحالة -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                <option value="available" {{ old('status', $property->status) == 'available' ? 'selected' : '' }}>Available</option>
                <option value="sold" {{ old('status', $property->status) == 'sold' ? 'selected' : '' }}>Sold</option>
                <option value="rented" {{ old('status', $property->status) == 'rented' ? 'selected' : '' }}>Rented</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- حقل الوصف -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $property->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- حقل تغيير الصورة الرئيسية -->
        <div class="mb-3">
            <label for="main_image" class="form-label">Change Main Image</label>
            <input type="file" name="main_image" id="main_image" class="form-control @error('main_image') is-invalid @enderror" accept="image/*">
            <p>Current Image:</p>
            <img src="{{ asset('storage/' . $property->images->where('is_primary', true)->first()?->image_url) }}" alt="Current Main Image" width="100">
            @error('main_image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Property</button>
    </form>
</div>
@endsection
