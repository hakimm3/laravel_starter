<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $sliders = \App\Models\Slider::all();
            return DataTables::of($sliders)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $image = '<img src="' . asset('storage/slider/' . $row->image) . '" width="100px">';
                    return $image;
                })
                ->addColumn('status', function ($slider) {
                    $status = $slider->status ? '<button class="btn btn-sm btn-success">Active</button>' : '<button class="btn btn-sm btn-danger">Inactive</button>';
                    return $status;
                })
                ->addColumn('action', 'admin.cms.slider.action')
                ->rawColumns(['action', 'status', 'image'])
                ->make(true);
        }

        return view('admin.cms.slider.index');
    }

    public function store(SliderRequest $request)
    {
        if ($request->id == null && $request->image == 'undefined') {
            return response()->json([
                'errors' => [
                    'image' => 'The image field is required if create new data.'
                ]
            ], 422);
        }

        $image = Slider::find($request->id)->image ?? null;
        if ($request->image != 'undefined') {
            $image = uploadPhoto($request->image, 'slider');
        }
        $slider = \App\Models\Slider::updateOrCreate(
            ['id' => $request->id],
            [
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'image' => $image,
            ]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Slider created successfully',
        ], 200);
    }

    public function edit($id)
    {
        $slider = \App\Models\Slider::find($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Slider fetched successfully',
            'data' => $slider,
        ], 200);
    }

    public function destroy($id)
    {
        $slider = \App\Models\Slider::find($id);
        $slider->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Slider deleted successfully',
        ], 200);
    }
}
