@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Details</div>

                <div class="card-body">
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Role:</strong> {{ $user->roles->pluck('name')->first() }}</p>

                    <a href="{{ route('users.index') }}" class="btn btn-primary">Back to Users</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
