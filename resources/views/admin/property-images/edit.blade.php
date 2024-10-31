@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Edit Image for Property: {{ $property->title }}</h1>
    
    <form action="{{ route('property-images.update', [$property->id, $propertyImage->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="image" class="form-label">Change Image (optional)</label>
            <input type="file" name="image" id="image" class="form-control">
            <p>Current Image:</p>
            <img src="{{ asset('storage/' . $propertyImage->image_url) }}" alt="Property Image" width="100">
        </div>
        
        <div class="form-check mb-3">
            <input type="checkbox" name="is_primary" id="is_primary" class="form-check-input" {{ $propertyImage->is_primary ? 'checked' : '' }}>
            <label for="is_primary" class="form-check-label">Set as Primary</label>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Image</button>
    </form>
</div>
@endsection

