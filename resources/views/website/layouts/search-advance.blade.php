<div class="container-xxl py-5">
    <div class="container" >
        <form action="{{ route('search') }}" method="GET">
            <div class="row">
                <!-- Location -->
                <div class="col-md-6" >
                    <div class="form-group">
                        <label for="location_id"><i class="fas fa-map-marker-alt"></i> Location</label>
                        <select name="location_id" id="location_id" class="form-control">
                            <option value="">Select Location</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ request('location_id') == $location->id ? 'selected' : '' }}>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Property Type -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="property_type_id"><i class="fas fa-home"></i> Property Type</label>
                        <select name="property_type_id" id="property_type_id" class="form-control">
                            <option value="">Select Property Type</option>
                            @foreach($propertyTypes as $type)
                                <option value="{{ $type->id }}" {{ request('property_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Min Price -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="min_price"><i class="fas fa-dollar-sign"></i> Min Price</label>
                        <input type="number" name="min_price" id="min_price" class="form-control" value="{{ request('min_price') }}">
                    </div>
                </div>
                <!-- Max Price -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="max_price"><i class="fas fa-dollar-sign"></i> Max Price</label>
                        <input type="number" name="max_price" id="max_price" class="form-control" value="{{ request('max_price') }}">
                    </div>
                </div>
                <!-- Number of Bedrooms -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="num_bedrooms"><i class="fas fa-bed"></i> Bedrooms</label>
                        <input type="number" name="num_bedrooms" id="num_bedrooms" class="form-control" value="{{ request('num_bedrooms') }}">
                    </div>
                </div>
                <!-- Number of Bathrooms -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="num_bathrooms"><i class="fas fa-bath"></i> Bathrooms</label>
                        <input type="number" name="num_bathrooms" id="num_bathrooms" class="form-control" value="{{ request('num_bathrooms') }}">
                    </div>
                </div>
                <!-- Directions -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="directions"><i class="fas fa-compass"></i> Directions</label>
                        <input type="text" name="directions" id="directions" class="form-control" value="{{ request('directions') }}">
                    </div>
                </div>
                <!-- Status -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status"><i class="fas fa-info-circle"></i> Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                            <option value="rented" {{ request('status') == 'rented' ? 'selected' : '' }}>Rented</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Buttons -->
            <div class="mt-6 d-flex justify-content-end" style="margin-top: 10px;">
                <button type="submit" class="btn btn-primary mr-2">
                    <i class="fas fa-filter"></i> Apply Filters
                </button>
                <a href="{{ route('search') }}" class="btn btn-default mr-2">
                    <i class="fas fa-sync-alt"></i> Reset
                </a>
            </div>
        </form>
    </div>
</div>