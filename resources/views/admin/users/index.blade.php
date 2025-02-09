@extends('admin.layouts.app')

@section('content')

    <h2>Users</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add User</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th> <!-- إضافة عنوان جديد للدور -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        {{ $user->roles->pluck('name')->implode(', ') }} <!-- عرض جميع الأدوار بفاصلة -->
                    </td>   
                     <td>
                   
                    
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

   
@endsection
