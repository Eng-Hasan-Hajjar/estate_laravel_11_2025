@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Property Types</h2>
    <a href="{{ route('property-types.create') }}" class="btn btn-primary">Add Property Type</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($propertyTypes as $propertyType)
                <tr>
                    <td>{{ $propertyType->id }}</td>
                    <td>{{ $propertyType->name }}</td>
                    <td>
                        <a href="{{ route('property-types.edit', $propertyType) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('property-types.destroy', $propertyType) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $propertyTypes->links() }}
</div>

@endsection
