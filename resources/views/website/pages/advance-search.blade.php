
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
        <!-- Search Start -->
        @include('website.layouts.search-advance')
        <!-- Search End -->
        <!-- Property List Start -->
        @include('website.layouts.property-list')
        <!-- Property List End -->
        <!-- Call to Action Start -->
        
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