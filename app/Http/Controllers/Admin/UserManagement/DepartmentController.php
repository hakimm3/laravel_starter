<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;
use App\Models\Department;
use Yajra\DataTables\Facades\DataTables;


class DepartmentController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $departments = Department::latest();
            return DataTables::eloquent($departments)
                ->addIndexColumn()
                ->addColumn('action', 'admin.user-management.department.action')
                ->make(true);
        }

        return view('admin.user-management.department.index');
    }

    public function store(DepartmentRequest $request){
        Department::updateOrCreate(['id' => $request->id], [
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Department saved successfully'
        ], 201);

    }

    public function edit($id){
        $department = Department::find($id);
        return response()->json([
            'success' => true,
            'data' => $department
        ], 200);
    }

    public function destroy($id){
        $department = Department::find($id);
        $department->delete();
        return response()->json([
            'success' => true,
        ], 200);
    }
}
