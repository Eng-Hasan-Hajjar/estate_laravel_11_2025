@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Add New Location</h2>
    
    <form action="{{ route('locations.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Location Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (Optional)</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
