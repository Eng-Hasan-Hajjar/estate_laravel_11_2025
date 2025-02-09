@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Users and Roles</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Current Roles</th>
                <th>Assign New Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ implode(', ', $user->roles->pluck('name')->toArray()) }}</td>
                    <td>
                        <form action="{{ route('users.roles.assign', $user) }}" method="POST">
                            @csrf
                            <select name="roles[]" multiple class="form-select">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ $user->roles->contains($role) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Update Roles</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
