<div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
    <div class="container">
        <form action="{{ route('properties.filterweb') }}" method="POST">
            @csrf

            <div class="row g-2">
                <div class="col-md-10">
                    <div class="row g-2">
                        <!-- حقل البحث بالكلمات المفتاحية -->
                        <div class="col-md-4">
                            <input type="text" name="keyword" class="form-control border-0 py-3" placeholder="Search Keyword" value="{{ request('keyword') }}">
                        </div>
                        
                        <!-- قائمة اختيار نوع العقار -->
                        <div class="col-md-4">
                            <select name="type" class="form-select border-0 py-3">
                                <option value="">Property Type</option>
                                @foreach($properties as $property)
                                    <option value="{{ $property->type }}" {{ request('type') == $property->type ? 'selected' : '' }}>
                                        {{ $property->type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- قائمة اختيار الموقع -->
                        <div class="col-md-4">
                            <select name="location" class="form-select border-0 py-3">
                                <option value="">Location</option>
                                @foreach($properties as $property)
                                    <option value="{{ $property->location }}" {{ request('location') == $property->location ? 'selected' : '' }}>
                                        {{ $property->location }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark border-0 w-100 py-3">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>
