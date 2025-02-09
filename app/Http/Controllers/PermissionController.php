<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;


class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate(10); // تأكد من استخدام paginate هنا
        return view('admin.permissions.index', compact('permissions'));

    
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        Permission::create(['name' => $request->name]);
        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
