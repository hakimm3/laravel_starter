<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\ThemeRequest;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Artisan;

class ThemeController extends Controller
{
    public function index()
    {
        return view('admin.cms.theme');
    }

    public function store(ThemeRequest $request){
        Setting::where('key', 'color_sidebar')->update(['value' => $request->color_sidebar]);
        Setting::where('key', 'color_sidebar_brand')->update(['value' => $request->color_sidebar_brand]);
        Setting::where('key', 'dark_mode')->update(['value' => 0]);
        if($request->has('dark_mode')) {
            Setting::where('key', 'dark_mode')->update(['value' => 1]);
        }
        Artisan::call('cache:clear');

        return redirect()->back()->with('success', 'Theme Setting updated successfully!');
    }
}
