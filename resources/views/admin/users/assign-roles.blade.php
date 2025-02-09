@extends('admin.layouts.app')


@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-user-tag"></i> Assign Roles to Users</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Current Roles</th>
                        <th>Assign Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="badge bg-primary">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <form action="{{ route('user.assign.role', $user->id) }}" method="POST">
                                    @csrf
                                    <select name="role_id" class="form-select">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fas fa-check"></i> Assign
                                </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach




                        @foreach($user->roles as $role)
                            <span class="badge bg-primary">
                                {{ $role->name }}
                                <form action="{{ route('user.remove.role', ['userId' => $user->id, 'roleId' => $role->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </span>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>








<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-user-tag"></i> إدارة الأدوار للمستخدمين</h4>
        </div>
        <div class="card-body">

            {{-- عرض الرسائل --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>المستخدم</th>
                        <th>الأدوار الحالية</th>
                        <th>إسناد دور جديد</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>
                                @forelse($user->roles as $role)
                                    <span class="badge bg-primary">
                                        {{ $role->name }}
                                        <form action="{{ route('user.remove.role', ['user' => $user->id, 'role' => $role->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </span>
                                @empty
                                    <span class="text-muted">لا يوجد أدوار</span>
                                @endforelse
                            </td>
                            <td>
                                <form action="{{ route('user.assign.role', $user->id) }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <select name="role_id" class="form-select">
                                            <option value="" disabled selected>اختر دورًا</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> إسناد
                                        </button>
                                    </div>
                                </form>
                            </td>
                            <td>
                                {{-- زر إسناد الدور --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>





@endsection