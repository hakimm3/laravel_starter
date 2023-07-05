<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with('department')
            ->when($request->status, function ($query) use ($request) {
                if ($request->status == 'All') {
                    return $query->withTrashed();
                }
                if ($request->status == 'Active') {
                    return $query->whereNull('deleted_at');
                }
                return $query->whereNotNull('deleted_at');
            })
            ->withTrashed()->latest();
            return DataTables::eloquent($users)
                ->addIndexColumn()
                ->addColumn('department', function ($row) {
                    return $row->department->name ?? '-';
                })
                ->addColumn('roles', function ($row) {
                    return '<span class="badge badge-secondary">' . $row->roles()->pluck('name')->implode(', ') . '</span>';
                })
                ->addColumn('photo', function ($row) {
                    if ($row->photo) {
                        return '<img src="' . asset('storage/user/' . $row->photo) . '" width="50px">';
                    }
                    return '-';
                })
                ->addColumn('status', function ($row) {
                    $status = $row->deleted_at ? 'Inactive' : 'Active';
                    $color = $row->deleted_at ? 'danger' : 'success';
                    return '<span class="badge badge-' . $color . '">' . $status . '</span>';
                })
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
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ], 200);
    }

    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();

        return response()->json([
            'success' => true,
            'message' => 'User restored successfully'
        ], 200);
    }
}
