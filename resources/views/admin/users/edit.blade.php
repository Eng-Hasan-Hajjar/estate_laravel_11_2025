@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit User</div>

                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Password (leave blank if not changing)</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="role">Role</label>
                            <select name="role" class="form-control" required>
                                @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->roles->pluck('name')->first() == $role->name ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Update User</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
