@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Location</h2>
    
    <form action="{{ route('locations.update', $location->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Location Name</label>
            <input type="text" name="name" class="form-control" value="{{ $location->name }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (Optional)</label>
            <textarea name="description" class="form-control">{{ $location->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
