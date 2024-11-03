@extends('admin.layouts.app')

@section('content')

<style>
    .img-overlay-container {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
    }

    .img-overlay-container img {
        transition: transform 0.3s ease;
        width: 100%; /* تأكد من عرض الصورة بشكل كامل */
        height: auto; /* الحفاظ على نسبة الطول والعرض */
    }

    .img-overlay-container:hover img {
        transform: scale(1.05);
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        opacity: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        transition: opacity 0.3s ease;
    }

    .img-overlay-container:hover .overlay {
        opacity: 1;
    }
    .modal-body img {
    max-width: 100%;
    height: auto; /* هذا سيحافظ على نسبة العرض والطول */
}

</style>

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

    <hr>

    <h4 class="mb-4 text-center">Image Gallery</h4>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
        @foreach($property->images as $index => $image)
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="img-overlay-container">
                        <img src="{{ asset('storage/' . $image->image_url) }}" 
                             class="card-img-top img-fluid rounded gallery-image" 
                             alt="Property Image" 
                             data-bs-toggle="modal" 
                             data-bs-target="#imageModal" 
                             data-index="{{ $index }}" 
                             data-url="{{ asset('storage/' . $image->image_url) }}" 
                             data-primary="{{ $image->is_primary ? 'Yes' : 'No' }}">
                        <div class="overlay">
                            <div class="overlay-text">
                                <p>Primary: {{ $image->is_primary ? 'Yes' : 'No' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark">
          <div class="modal-header border-0">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            <img src="" class="img-fluid" id="modalImage" alt="Large Property Image">
            <p class="text-muted mt-3" id="primaryText"></p>
          </div>
          <div class="modal-footer justify-content-between border-0">
            <button class="btn btn-secondary" id="prevImage">&larr; Previous</button>
            <button class="btn btn-secondary" id="nextImage">Next &rarr;</button>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const images = document.querySelectorAll('.gallery-image');
        const modalImage = document.getElementById('modalImage');
        const primaryText = document.getElementById('primaryText');
        let currentIndex = 0;

            const updateModalContent = (index) => {
        const image = images[index];
        modalImage.src = image.getAttribute('data-url');
        primaryText.textContent = "Primary: " + image.getAttribute('data-primary');
        currentIndex = index;

        // إظهار المودال بعد تحديث المحتوى
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        modal.show();
    };

        images.forEach((image, index) => {
            image.addEventListener('click', () => {
                updateModalContent(index);
            });
        });

        document.getElementById('prevImage').addEventListener('click', () => {
            if (currentIndex > 0) {
                updateModalContent(currentIndex - 1);
            } else {
                updateModalContent(images.length - 1);
            }
        });

        document.getElementById('nextImage').addEventListener('click', () => {
            if (currentIndex < images.length - 1) {
                updateModalContent(currentIndex + 1);
            } else {
                updateModalContent(0);
            }
        });
    });
</script>
