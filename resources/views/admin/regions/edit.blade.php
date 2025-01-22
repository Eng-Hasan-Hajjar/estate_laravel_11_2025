@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Region</h2>
    <form action="{{ route('regions.update', $region) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Region Name</label>
            <input type="text" name="name" class="form-control" value="{{ $region->name }}" required>
        </div>
        <div class="mb-3">
            <label for="location_id" class="form-label">Location</label>
            <select name="location_id" class="form-select" required>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}" {{ $region->location_id == $location->id ? 'selected' : '' }}>
                        {{ $location->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>@endsection
