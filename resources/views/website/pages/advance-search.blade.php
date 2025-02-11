
<!DOCTYPE html>
<html lang="en">

<head>
    @include('website.layouts.head')
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        @include('website.layouts.spinner')
        <!-- Spinner End -->


        <!-- Navbar Start -->
        @include('website.layouts.nav-bar')
        <!-- Navbar End -->


        <!-- Header Start -->
        <div class="container-fluid header bg-white p-0">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <h1 class="display-5 animated fadeIn mb-4">Property List</h1> 
                        <nav aria-label="breadcrumb animated fadeIn">
                        <ol class="breadcrumb text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-body active" aria-current="page">Property List</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 animated fadeIn">
                    <img class="img-fluid" src="{{asset('website/img/header.jpg')}}" alt="">
                </div>
            </div>
        </div>
        <!-- Header End -->


        <!-- Search Start -->
        <div class="container-xxl py-5">
            <div class="container">
 
                <form action="{{ route('search') }}" method="GET">
                    <div class="row">
                        <!-- Location -->
                        <div class="col-md-6">
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
                        <a href="{{ route('properties.index') }}" class="btn btn-default mr-2">
                            <i class="fas fa-sync-alt"></i> Reset
                        </a>
        
                    </div>
                </form>

            </div>
        </div>






        <!-- Search End -->

       
        
        <!-- Property List Start -->






        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-0 gx-5 align-items-end">
                    <div class="col-lg-6">
                        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                            <h3 class="mb-3">Discover Your Perfect Property</h3>
                            <p>
                                Find your dream home with ease. Explore a wide range of properties tailored to your needs, from cozy apartments to luxurious villas.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                        <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-primary active" data-bs-toggle="pill" href="#tab-1">Featured</a>
                            </li>
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-2">For Sell</a>
                            </li>
                            <li class="nav-item me-0">
                                <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-3">For Rent</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row g-4">
                    @forelse ($properties as $property)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="property-item rounded overflow-hidden">
                                <div class="position-relative overflow-hidden">
                                    <a href=""><img class="img-fluid" src="{{ asset('storage/' . $property->images->first()->path) }}" alt=""></a>
                                    <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                        {{ $property->status == 'sale' ? 'For Sale' : 'For Rent' }}
                                    </div>
                                    <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                        {{ $property->propertyType->name }}
                                    </div>
                                </div>
                                <div class="p-4 pb-0">
                                    <h5 class="text-primary mb-3">${{ number_format($property->price) }}</h5>
                                    <a class="d-block h5 mb-2" href="">{{ $property->title }}</a>
                                    <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $property->location->name }}</p>
                                </div>
                                <div class="d-flex border-top">
                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{ $property->size }} Sqft</small>
                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{ $property->num_bedrooms }} Bed</small>
                                    <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>{{ $property->num_bathrooms }} Bath</small>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <h4>
                                No properties were found matching your search.
                        </h4>
                        </div>
                    @endforelse
                </div>
                
                <!-- أزرار التصفح -->
                <div class="col-12 text-center mt-4">
                    {{ $properties->links() }}
                </div>
            </div>
        </div>
        <!-- Property List End -->


        <!-- Call to Action Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="bg-light rounded p-3">
                    <div class="bg-white rounded p-4" style="border: 1px dashed rgba(0, 185, 142, .3)">
                        <div class="row g-5 align-items-center">
                            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                                <img class="img-fluid rounded w-100" src="img/call-to-action.jpg" alt="">
                            </div>
                            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                                <div class="mb-4">
                                    <h1 class="mb-3">Contact With Our Certified Agent</h1>
                                    <p></p>
                                </div>
                                <a href="" class="btn btn-primary py-3 px-4 me-2"><i class="fa fa-phone-alt me-2"></i>Make A Call</a>
                                <a href="" class="btn btn-dark py-3 px-4"><i class="fa fa-calendar-alt me-2"></i>Get Appoinment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call to Action End -->
        

        <!-- Footer Start -->
        @include('website.layouts.footer')
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    @include('website.layouts.script')
</body>



</html>