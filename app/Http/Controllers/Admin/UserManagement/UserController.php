<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with('department')
                ->when($request->status !== 'All', function ($query) use ($request) {
                    if ($request->status === 'Active') {
                        return $query->whereNull('deleted_at');
                    }
                    return $query->whereNotNull('deleted_at');
                })
                ->withTrashed()
                ->orderBy('id', 'asc');

            return DataTables::eloquent($users)
                ->addIndexColumn()
                ->addColumn('department', function ($row) {
                    return $row->department->name ?? '-';
                })
                ->addColumn('roles', function ($row) {
                    $roles = '';
                    foreach ($row->roles as $role) {
                        $roles .= '<span class="badge badge-info">' . $role->name . '</span> ';
                    }
                    return $roles;
                })
                ->addColumn('status', 'admin._status')
                ->addColumn('action', 'admin.user-management.user.action')
                ->rawColumns(['action', 'roles', 'photo', 'status'])
                ->make(true);
        }

        $departments = Department::all();
        $roles = Role::all();
        $compact = compact(
            'departments',
            'roles'
        );
        return view('admin.user-management.user.index', $compact);
    }

    public function store(UserRequest $request)
    {
        $user = User::withTrashed()->updateOrCreate(
            ['id' => $request->id],
            [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'department_id' => $request->department_id,
            ]
        );
        $user->syncRoles($request->roles);




        return response()->json([
            'success' => true,
            'message' => 'User saved successfully'
        ], 200);
    }

    public function edit($id)
    {
        $user = User::withTrashed()->with('roles')->find($id);
        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::withTrashed()->find($id);
        $message = 'User deleted successfully';

        if ($user->trashed()) {
            $user->restore();
            $message = 'User restored successfully';
        } else {
            $user->delete();
        }

        return response()->json([
            'success' => true,
            'message' => $message
        ], 200);
    }
}
