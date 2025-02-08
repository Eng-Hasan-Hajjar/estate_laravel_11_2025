@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Properties List</h1>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-filter"></i> Filter Properties</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('properties.index') }}" method="GET">
                    <div class="row g-3">
                        <!-- Location -->
                        <div class="col-md-6">
                            <label for="location_id" class="form-label"><i class="fas fa-map-marker-alt"></i> Location</label>
                            <select name="location_id" id="location_id" class="form-select">
                                <option value="">Select Location</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ request('location_id') == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
    
                        <!-- Property Type -->
                        <div class="col-md-6">
                            <label for="property_type_id" class="form-label"><i class="fas fa-home"></i> Property Type</label>
                            <select name="property_type_id" id="property_type_id" class="form-select">
                                <option value="">Select Property Type</option>
                                @foreach($propertyTypes as $type)
                                    <option value="{{ $type->id }}" {{ request('property_type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
    
                        <!-- Min Price -->
                        <div class="col-md-6">
                            <label for="min_price" class="form-label"><i class="fas fa-dollar-sign"></i> Min Price</label>
                            <input type="number" name="min_price" id="min_price" class="form-control" value="{{ request('min_price') }}">
                        </div>
    
                        <!-- Max Price -->
                        <div class="col-md-6">
                            <label for="max_price" class="form-label"><i class="fas fa-dollar-sign"></i> Max Price</label>
                            <input type="number" name="max_price" id="max_price" class="form-control" value="{{ request('max_price') }}">
                        </div>
    
                        <!-- Number of Bedrooms -->
                        <div class="col-md-6">
                            <label for="num_bedrooms" class="form-label"><i class="fas fa-bed"></i> Bedrooms</label>
                            <input type="number" name="num_bedrooms" id="num_bedrooms" class="form-control" value="{{ request('num_bedrooms') }}">
                        </div>
    
                        <!-- Number of Bathrooms -->
                        <div class="col-md-6">
                            <label for="num_bathrooms" class="form-label"><i class="fas fa-bath"></i> Bathrooms</label>
                            <input type="number" name="num_bathrooms" id="num_bathrooms" class="form-control" value="{{ request('num_bathrooms') }}">
                        </div>
    
                        <!-- Directions -->
                        <div class="col-md-6">
                            <label for="directions" class="form-label"><i class="fas fa-compass"></i> Directions</label>
                            <input type="text" name="directions" id="directions" class="form-control" value="{{ request('directions') }}">
                        </div>
    
                        <!-- Status -->
                        <div class="col-md-6">
                            <label for="status" class="form-label"><i class="fas fa-info-circle"></i> Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="">Select Status</option>
                                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                                <option value="rented" {{ request('status') == 'rented' ? 'selected' : '' }}>Rented</option>
                            </select>
                        </div>
                    </div>
    
                    <!-- Buttons -->
                    <div class="mt-4 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-filter"></i> Apply Filters
                        </button>
                        <a href="{{ route('properties.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-sync-alt"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- زر إضافة عقار جديد -->
    <a href="{{ route('properties.create') }}" class="btn btn-primary mb-3">Add New Property</a>

    

    <!-- عرض قائمة العقارات -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                   
                    <th>Title</th>
                    <th>Location</th>
                    <th>Type</th>
                  
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($properties as $property)
                    <tr>
                        <td>{{ $property->title }}</td>
                        <td>{{ optional($property->location)->name ?? 'N/A' }}</td>
                        <td>{{ optional($property->property_type)->name ?? 'N/A' }}</td>

                      
                       <td class="d-flex justify-content-start align-items-center gap-3">  <!-- زيادة المسافة هنا -->
                        <a href="{{ route('properties.show', $property->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('properties.property-images.create', $property->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus-circle"></i> Add Image
                        </a>
                        <a href="{{ route('comments.index', $property->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i> Show Comments
                        </a>
                      
                        <form action="{{ route('properties.destroy', $property->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
                    </td>
                    
                        
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- رابط التنقل بين الصفحات -->
    {{ $properties->links() }}
</div>
@endsection
