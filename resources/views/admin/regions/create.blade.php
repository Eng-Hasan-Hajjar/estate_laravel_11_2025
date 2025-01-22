@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Add New Region</h2>
    <form action="{{ route('regions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Region Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="location_id" class="form-label">Location</label>
            <select name="location_id" class="form-select" required>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
