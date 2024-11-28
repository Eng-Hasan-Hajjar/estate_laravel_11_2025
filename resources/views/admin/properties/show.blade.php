    @extends('admin.layouts.app')

    @section('content')
    <div class="container-fluid">
        <!-- Property Header -->
        <div class="card bg-light mb-4">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title m-0">{{ $property->title }}</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Property Details -->
                    <div class="col-md-8">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-info text-white">
                                <h5 class="m-0">Property Details</h5>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong>Location:</strong> {{ $property->location }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Price:</strong> {{ number_format($property->price, 2) }} SYP
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Type:</strong> {{ ucfirst($property->type) }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Description:</strong> {{ $property->description }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Area:</strong> {{ $property->area }} sq. ft.
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Bedrooms:</strong> {{ $property->num_bedrooms }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Bathrooms:</strong> {{ $property->num_bathrooms }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Status:</strong> {{ ucfirst($property->status) }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Main Image -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="m-0">Main Image</h5>
                            </div>
                            <div class="card-body p-0">
                                @if($property->mainImage)
                                    <img src="{{ asset('storage/'. $property->mainImage->image_url) }}" alt="Main Image" class="img-fluid rounded mb-3">
                                @else
                                    <p class="text-center text-muted py-3">No main image available</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Image Gallery -->
    <div class="card mb-5">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="m-0">Image Gallery</h4>
        </div>
        <div class="card-body position-relative">
            <div class="container-fluid p-0 d-flex justify-content-center">
                @foreach($property->images as $index => $image)
                    <div class="mySlides mb-3" style="width: 600px; height: 400px; overflow: hidden;">
                        <img src="{{ asset('storage/' . $image->image_url) }}" class="img-fluid rounded shadow-sm" style="width: 100%; height: 100%; object-fit: contain ;">
                    </div>
                @endforeach
                <button class="modal-navigation-btn prev-btn btn btn-outline-primary" onclick="plusDivs(-1)">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="modal-navigation-btn next-btn btn btn-outline-primary" onclick="plusDivs(1)">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

        <!-- comments Form -->
        @include('admin.comments.add-button')
        @include('admin.comments.view-comments')

        <!-- Rating Form -->


        @include('admin.properties.rating-form')
        @include('admin.properties.rating-view')




        <script>
            var slideIndex = 1;
            showSlides(slideIndex);

            function plusDivs(n) {
                showSlides(slideIndex += n);
            }

            function showSlides(n) {
                var i;
                var x = document.getElementsByClassName("mySlides");
                if (n > x.length) { slideIndex = 1 }
                if (n < 1) { slideIndex = x.length }
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                x[slideIndex - 1].style.display = "block";
            }
        </script>
    </div>
    @endsection
