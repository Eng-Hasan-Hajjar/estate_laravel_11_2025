<head>
    @include('website.layouts.head')
</head>
<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start-->
        @include('website.layouts.spinner')
        <!-- Spinner End -->
        <!-- Navbar Start -->
        @include('website.layouts.nav-bar')
        <!-- Navbar End -->
         <!-- About Start -->
         <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="about-img position-relative overflow-hidden p-5 pe-0">
                            <img class="img-fluid w-100" src="{{asset('website/img/about.jpg')}}">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">#1 Place To Find The Perfect Property</h1>
                        <p class="mb-4">
                            Enjoy a smooth and fast search experience for properties that suit your needs. We provide you with a variety of options in prime locations and competitive prices, to help you find the perfect property with ease.
                        </p>
                        <p><i class="fa fa-check text-primary me-3"></i>Prime locations and multiple options</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Competitive prices to suit everyone</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Easy and fast search experience</p>
                    </div>
                </div>
            </div>
        </div>
         <!-- About End -->
        <!-- Call to Action Start -->
        @include('website.layouts.call-action')
        <!-- Call to Action End -->
        <!-- Testimonial Start -->
        
        <!-- Testimonial End -->
        <!-- Footer Start -->
        @include('website.layouts.footer')
        <!-- Footer End -->
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <!-- JavaScript Libraries -->
  @include('website.layouts.script')
</body>