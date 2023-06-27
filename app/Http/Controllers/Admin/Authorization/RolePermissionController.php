<?php

namespace App\Http\Controllers\Admin\Authorization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function __invoke(Request $request, $id)
    {
            $role = Role::find(Crypt::decrypt($id));
            $permissions = collect($request->permissions);
            $role->syncPermissions($permissions);

            return redirect()->route('authorization.role.index')->with('success', 'Role permission updated successfully');
    }
}
