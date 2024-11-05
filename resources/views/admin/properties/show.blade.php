@extends('admin.layouts.app')

<head>
    <style>
        .mySlides { display: none; 
        
        padding: 10px;
        margin: 10px;
        border:10px;
        
        border-color:#3f6791;
        border-style: double;
      margin-bottom: 20px;
      padding-bottom: 20px;
        
        }
        .modal-navigation-btn {
            position: absolute;
            top: 150%;
            transform: translateY(-50%);
            background-color: rgba(5, 101, 179, 0.5);
            border: none;
            color: #3f6791;
            padding: 5px;
            font-size: 50px;
            cursor: pointer;
            border-radius: 100%;
        }
        .prev-btn { left: 30%; }
        .next-btn { right: 10%; }
    </style>
</head>

@section('content')
<div class="container">
    <h1 class="my-4">{{ $property->title }}</h1>

    <div class="row">
        <div class="col-md-8">
            <h5>Property Details</h5>
            <ul class="list-group mb-3">
                <li class="list-group-item">Location: {{ $property->location }}</li>
                <li class="list-group-item">Price: {{ number_format($property->price, 2) }} SYP</li>
                <li class="list-group-item">Type: {{ ucfirst($property->type) }}</li>
                <li class="list-group-item">Description: {{ $property->description }}</li>
                <li class="list-group-item">Area: {{ $property->area }} sq. ft.</li>
                <li class="list-group-item">Bedrooms: {{ $property->num_bedrooms }}</li>
                <li class="list-group-item">Bathrooms: {{ $property->num_bathrooms }}</li>
                <li class="list-group-item">Status: {{ ucfirst($property->status) }}</li>
            </ul>
        </div>

        <div class="col-md-4">
            <h5>Main Image</h5>
            @if($property->mainImage)
                <img src="{{ asset('storage/' . $property->mainImage->image_url) }}" alt="Main Image" class="img-fluid mb-3">
            @else
                <p>No main image available</p>
            @endif
        </div>
    </div>

    <h4 class="mb-4 text-center">Image Gallery</h4>

    <div   style="margin-bottom:200px">

        <div class="container">
            @foreach($property->images as $index => $image)
                <img class="mySlides" src="{{ asset('storage/' . $image->image_url) }}" style="width:100%">
          
                @endforeach
                <button class="modal-navigation-btn prev-btn" onclick="plusDivs(-1)">&#10094;</button>
                <button class="modal-navigation-btn next-btn" onclick="plusDivs(1)">&#10095;</button>

        </div>
    


    </div>
<br>




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
