@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Add New Image to Property: {{ $property->title }}</h1>
    
    <form action="{{ route('properties.property-images.store', $property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>
        
        <div class="form-check mb-3">
            <input type="checkbox" name="is_primary" id="is_primary" class="form-check-input">
            <label for="is_primary" class="form-check-label">Set as Primary</label>
        </div>
        
        <button type="submit" class="btn btn-primary">Add Image</button>
    </form>
</div>
@endsection
