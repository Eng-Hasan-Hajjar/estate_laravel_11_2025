<!DOCTYPE html>
<html lang="en">

<head>
    @include('website.layouts.head')
    <style>
        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 220px; /* لضمان أن الصورة تبقى في الوسط دائماً */
            width: 100%;
        }
    
        .property-image {
            width: 100%;
            height: auto;
            max-width: 300px; /* ضبط الحجم الأقصى للصورة */
            max-height: 200px;
            object-fit: cover; /* ضمان عدم تشويه الصور */
            border-radius: 8px;
        }
    
        .property-item {
            text-align: center; /* محاذاة جميع العناصر للوسط */
        }
    </style>
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
        <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <div class="container">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" class="form-control border-0 py-3" placeholder="Search Keyword">
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0 py-3">
                                    <option selected>Property Type</option>
                                    <option value="1">Property Type 1</option>
                                    <option value="2">Property Type 2</option>
                                    <option value="3">Property Type 3</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0 py-3">
                                    <option selected>Location</option>
                                    <option value="1">Location 1</option>
                                    <option value="2">Location 2</option>
                                    <option value="3">Location 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-dark border-0 w-100 py-3">Search</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Search End -->


        <!-- Property List Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-0 gx-5 align-items-end">
                    <div class="col-lg-6">
                        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                            <h1 class="mb-3">Property Listing</h1>
                            <p>Explore different types of properties with detailed descriptions, prices, and locations to help you make the best choice.</p>
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
        
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            @foreach($properties as $property)
                                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class=" rounded overflow-hidden">
                                        <div class="property-item position-relative overflow-hidden">
                                            <a href="{{ route('propertyweb.details', $property->id) }}">
                                                <img class="img-fluid"  style="width: 300px; height: 200px;"
                                                     src="{{ optional($property->mainImage)->image_url 
                                                          ? asset('storage/'.$property->mainImage->image_url) 
                                                          : asset('img/default.jpg') }}" 
                                                     alt="Property Image">
                                            </a>
                                            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                                {{ $property->status }}
                                            </div>
                                            <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                                {{ $property->type }}
                                            </div>
                                        </div>
                                        <div class="p-4 pb-0">
                                            <h5 class="text-primary mb-3">${{ number_format($property->price, 2) }}</h5>
                                            <a class="d-block h5 mb-2" href="">{{ $property->title }}</a>
                                            <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $property->location }}</p>
                                        </div>
                                        <div class="d-flex border-top">
                                            <small class="flex-fill text-center border-end py-2">
                                                <i class="fa fa-ruler-combined text-primary me-2"></i>{{ $property->area }} Sqft
                                            </small>
                                            <small class="flex-fill text-center border-end py-2">
                                                <i class="fa fa-bed text-primary me-2"></i>{{ $property->num_bedrooms }} Bed
                                            </small>
                                            <small class="flex-fill text-center py-2">
                                                <i class="fa fa-bath text-primary me-2"></i>{{ $property->num_bathrooms }} Bath
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
        <!-- Property List End -->


       
        <!-- Call to Action Start -->
        @include('website.layouts.call-action')
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