@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Regions</h2>
    <a href="{{ route('regions.create') }}" class="btn btn-primary">Add Region</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($regions as $region)
                <tr>
                    <td>{{ $region->id }}</td>
                    <td>{{ $region->name }}</td>
                    <td>{{ $region->location->name }}</td>
                    <td>
                        <a href="{{ route('regions.edit', $region) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('regions.destroy', $region) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $regions->links() }}
</div>

@endsection
