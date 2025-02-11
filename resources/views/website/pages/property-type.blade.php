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
        <!-- Category Start -->
        @include('website.layouts.category')
        <!-- Category End -->
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