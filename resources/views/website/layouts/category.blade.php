<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Property Types</h1>
            <p>Types of properties available on the site.</p>
        </div>
        <div class="row g-4">
            @foreach($propertyTypes as $propertyType)
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.{{ $loop->iteration }}s">
                    <a class="cat-item d-block bg-light text-center rounded p-3" href="{{ route('propertytypeweb.single', $propertyType->id) }}">
                        <div class="rounded p-4">
                            <div class="icon mb-3">
                                <img class="img-fluid" src="{{ asset('website/img/icon-villa.png') }}" alt="Icon">
                            </div>
                            <h6>{{ $propertyType->name }}</h6>
                            <span>{{ $propertyType->properties_count }} Properties</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>