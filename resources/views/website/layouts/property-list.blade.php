<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-6">
                <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                    <h1 class="mb-3">Property Listing</h1>
                    <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit diam justo sed rebum.</p>
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