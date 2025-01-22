@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Add New Property Type</h2>
    <form action="{{ route('property-types.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Property Type Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
