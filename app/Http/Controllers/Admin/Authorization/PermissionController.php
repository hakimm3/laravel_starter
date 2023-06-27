<?php

namespace App\Http\Controllers\Admin\Authorization;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Rules\MinWords;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            return DataTables::eloquent(Permission::latest())
                ->addIndexColumn()
                ->addColumn('action', 'admin.authorization.permission.action')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.authorization.permission.index');
    }

    public function store(Request $request){
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:permissions,name,' . $request->id,
                new MinWords(2),
            ]
        ]);
        $permission = Permission::updateOrCreate(
            ['id' => $request->id],
            [
                'name' => $request->name,
                'guard_name' => 'web',
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Permission saved successfully',
           ], 200);
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        return response()->json([
            'success' => true,
            'message' => 'Permission fetched successfully',
            'data' => $permission,
        ], 200);
    }

    public function destroy($id)
    {
        Permission::destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Permission deleted successfully',
        ], 200);
    }
}
