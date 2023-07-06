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
            $data = Permission::
            when($request->status, function($query) use ($request){
                if($request->status == 'All'){
                    return $query->withTrashed();
                }
                if($request->status == 'Active'){
                    return $query->whereNull('deleted_at');
                }
                return $query->whereNotNull('deleted_at');
            })
            ->withTrashed()
            ->latest();
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('status', 'admin._status')
                ->addColumn('action', 'admin.authorization.permission.action')
                ->rawColumns(['action', 'status'])
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
        $permission = Permission::withTrashed()->updateOrCreate(
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
        $permission = Permission::withTrashed()->find($id);
        return response()->json([
            'success' => true,
            'message' => 'Permission fetched successfully',
            'data' => $permission,
        ], 200);
    }

    public function destroy($id)
    {
        $permission = Permission::withTrashed()->find($id);
        $message = 'Permission deleted successfully';
        if($permission->trashed()){
            $permission->restore();
            $message = 'Permission restored successfully';
        }else{
            $permission->delete();
        }

        return response()->json([
            'success' => true,
            'message' => $message,
        ], 200);
    }
}
