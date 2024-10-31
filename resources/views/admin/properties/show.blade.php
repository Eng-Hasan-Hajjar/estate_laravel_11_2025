@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">{{ $property->title }}</h1>
    
    <div class="row">
        <div class="col-md-8">
            <h5>Property Details</h5>
            <ul class="list-group mb-3">
                <li class="list-group-item">Location: {{ $property->location }}</li>
                <li class="list-group-item">Price:  {{ number_format($property->price, 2) }}   SYP </li>
                <li class="list-group-item">Type: {{ ucfirst($property->type) }}</li>
                <li class="list-group-item">Description: {{ $property->description }}</li>
                <li class="list-group-item">Area: {{ $property->area }} sq. ft.</li>
                <li class="list-group-item">Bedrooms: {{ $property->num_bedrooms }}</li>
                <li class="list-group-item">Bathrooms: {{ $property->num_bathrooms }}</li>
                <li class="list-group-item">Status: {{ ucfirst($property->status) }}</li>
            </ul>
        </div>
        
       
        <div class="col-md-4">
            <h5>Main Image</h5>
            @if($property->mainImage)
                <img src="{{ asset('storage/' . $property->mainImage->image_url) }}" alt="Main Image" class="img-fluid mb-3">
            @else
                <p>No main image available</p>
            @endif
        </div>
    </div>
    
    <hr>

    <h4>Image Gallery</h4>
    <div class="row">
        @foreach($property->images as $image)
            <div class="col-md-3">
                <div class="card mb-4">
                    <img src="{{ asset('storage/' . $image->image_url) }}" class="card-img-top" alt="Property Image">
                    <div class="card-body">
                        <p class="card-text">Primary: {{ $image->is_primary ? 'Yes' : 'No' }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
