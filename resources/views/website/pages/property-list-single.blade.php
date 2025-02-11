<!DOCTYPE html>
<html lang="en">
<head>
    @include('website.layouts.head')
    <style>
        .property-details-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }
        .property-image {
            width: 100%;
            height: auto;
            max-height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }
        .details-box {
            margin-top: 20px;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 8px;
        }
        .gallery-image {
            width: 150px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .gallery-image:hover {
            transform: scale(1.1);
        }
        /* تصميم النافذة المنبثقة */
        .image-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }

        .image-popup img {
            max-width: 80%;
            max-height: 80%;
            border-radius: 8px;
        }

        .close-popup {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 30px;
            color: white;
            cursor: pointer;
        }
        .prev-btn, .next-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(255, 255, 255, 0.3);
            border: none;
            font-size: 30px;
            color: white;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .prev-btn {
            left: 20px;
        }

        .next-btn {
            right: 20px;
        }
        .prev-btn:hover, .next-btn:hover {
            background-color: rgba(255, 255, 255, 0.6);
        }
    </style>
</head>
<body>
    <div class="container-xxl bg-white p-0">
        @include('website.layouts.spinner')
        @include('website.layouts.nav-bar')
        <div class="container property-details-container">
            <h1 class="text-center">{{ $property->title }}</h1>
            <img class="property-image" 
                 src="{{ optional($property->mainImage)->image_url 
                      ? asset('storage/'.$property->mainImage->image_url) 
                      : asset('img/default.jpg') }}" 
                 alt="Property Image">
            <div class="details-box">
                <h4>Details</h4>
                <p><strong>Price:</strong> ${{ number_format($property->price, 2) }}</p>
                <p><strong>Location:</strong> {{ $property->location->name }}</p>
                <p><strong>Region:</strong> {{ $property->region->name }}</p>
                <p><strong>Status:</strong> {{ $property->status }}</p>
                <p><strong>Type:</strong> {{ $property->PropertyType->name }}</p>
                <p><strong>Area:</strong> {{ $property->area }} Sqft</p>
                <p><strong>Bedrooms:</strong> {{ $property->num_bedrooms }}</p>
                <p><strong>Bathrooms:</strong> {{ $property->num_bathrooms }}</p>
                <p><strong>Description:</strong> {{ $property->description }}</p>
            </div>
        <!-- معرض الصور -->
        <h3 class="mt-5">Property Gallery</h3>
        <div class="gallery-container">
            @foreach($property->images as $index => $image)
                <img class="gallery-image" src="{{ asset('storage/' . $image->image_url) }}" 
                    alt="Property Image" 
                    onclick="openPopup('{{ asset('storage/' . $image->image_url) }}', {{ $index }})">
            @endforeach
        </div>
        <!-- نافذة عرض الصورة المكبرة مع أزرار التحكم -->
        <div class="image-popup" id="imagePopup">
            <span class="close-popup" onclick="closePopup()">&times;</span>
            <button class="prev-btn" onclick="prevImage()">&#10094;</button>
            <img id="popupImage" src="" alt="Large Image">
            <button class="next-btn" onclick="nextImage()">&#10095;</button>
        </div>
    </div>
        @include('website.layouts.footer')
    </div>
    @include('website.layouts.script')
</body>
</html>
