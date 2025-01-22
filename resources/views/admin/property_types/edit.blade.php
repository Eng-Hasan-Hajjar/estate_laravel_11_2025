@extends('admin.layouts.app')

@section('content')

<div class="container">
    <h2>Edit Property Type</h2>
    <form action="{{ route('property-types.update', $propertyType) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Property Type Name</label>
            <input type="text" name="name" class="form-control" value="{{ $propertyType->name }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>

@endsection
