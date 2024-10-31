@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Images for Property: {{ $property->title }}</h1>
    
    <a href="{{ route('property-images.create', $property->id) }}" class="btn btn-primary mb-3">Add New Image</a>

    <div class="row">
        @foreach($images as $image)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('storage/' . $image->image_url) }}" class="card-img-top" alt="Property Image">
                    <div class="card-body">
                        <p class="card-text">Primary: {{ $image->is_primary ? 'Yes' : 'No' }}</p>
                        <a href="{{ route('property-images.edit', [$property->id, $image->id]) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('property-images.destroy', [$property->id, $image->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
