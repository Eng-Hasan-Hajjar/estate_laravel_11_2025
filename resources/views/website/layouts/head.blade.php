<meta charset="utf-8">
<title>Your Property </title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta content="" name="keywords">
<meta content="" name="description">

<!-- Favicon -->
<link href="{{asset('website/img/favicon.ico')}}" rel="icon">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">

<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="{{asset('website/lib/animate/animate.min.css')}}" rel="stylesheet">
<link href="{{asset('website/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

<!-- Customized Bootstrap Stylesheet -->
<link href="{{asset('website/css/bootstrap.min.css')}}" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="{{asset('website/css/style.css')}}" rel="stylesheet">


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