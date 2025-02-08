@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Regions</h2>
    <a href="{{ route('regions.create') }}" class="btn btn-primary">Add Region</a>
   
    <form action="{{ route('regions.index') }}" method="GET">
        <div class="form-group">
            <label for="name">Filter by Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}">
        </div>
        <div class="form-group">
            <label for="location_id">Filter by Location:</label>
            <select name="location_id" id="location_id" class="form-control">
                <option value="">Select Location</option>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}" {{ request('location_id') == $location->id ? 'selected' : '' }}>
                        {{ $location->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('regions.index') }}" class="btn btn-secondary">Reset</a>
    </form>
    
   
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

</div>

@endsection
