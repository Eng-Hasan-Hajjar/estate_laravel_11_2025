@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($role) ? 'Edit Role' : 'Create Role' }}</h2>
    <form action="{{ isset($role) ? route('roles.update', $role) : route('roles.store') }}" method="POST">
        @csrf
        @if (isset($role))
            @method('PUT')
        @endif
        <div class="mb-3">
            <label for="name" class="form-label">Role Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $role->name ?? '' }}" required>
        </div>
        <div class="mb-3">
            <label for="permissions" class="form-label">Permissions</label>
            <select name="permissions[]" id="permissions" class="form-select" multiple required>
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->name }}" {{ isset($role) && $role->permissions->contains($permission) ? 'selected' : '' }}>
                        {{ $permission->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
