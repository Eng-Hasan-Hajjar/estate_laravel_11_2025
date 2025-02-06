@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>Manage Locations</h2>
        <a href="{{ route('locations.create') }}" class="btn btn-primary">Add New Location</a>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($locations as $location)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $location->name }}</td>
                        <td>{{ $location->description }}</td>
                        <td>
                            <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('locations.destroy', $location->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

      
    </div>

@endsection
