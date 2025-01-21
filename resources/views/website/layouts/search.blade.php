<div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
    <div class="container">
        <div class="row g-2">
            <div class="col-md-10">
                <div class="row g-2">
                    <div class="col-md-4">
                        <input type="text" class="form-control border-0 py-3" placeholder="Search Keyword">
                    </div>
                 
                    <div class="col-md-4">
                        <select class="form-select border-0 py-3">
                            @if($properties->isNotEmpty())
                                <option selected>Property Type</option>
                                @foreach($properties as $property)
                                    <option value="{{ $property->type }}">{{ $property->type }}</option>
                                @endforeach
                            @else
                                <option selected disabled>No Property Types Available</option>
                            @endif
                        </select>
                    </div>

                    <div class="col-md-4">
                        <select class="form-select border-0 py-3">
                            @if($properties->isNotEmpty())
                                <option selected>Location</option>
                                @foreach($properties as $property)
                         
                                    <option value="{{ $property->location }}">{{ $property->location }}</option>
                                @endforeach
                            @else
                                <option selected disabled>No Locations Available</option>
                            @endif
                        </select>
                    </div>
               
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-dark border-0 w-100 py-3">Search</button>
            </div>
        </div>
    </div>
</div>