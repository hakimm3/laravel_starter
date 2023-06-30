<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiteRequest;
use Illuminate\Http\Request;
use App\Models\Setting;

class SiteController extends Controller
{
    public function index()
    {
        $setting = Setting::all();
        return view('admin.cms.site', compact('setting'));
    }

    public function store(SiteRequest $request)
    { 
        Setting::where('key', 'brand_name')->update(['value' => $request->brand_name]);
        Setting::where('key', 'brand_phone')->update(['value' => $request->brand_phone]);
        Setting::where('key', 'brand_address')->update(['value' => $request->brand_address]);
        Setting::where('key', 'site_name')->update(['value' => $request->site_name]);
        Setting::where('key', 'site_description')->update(['value' => $request->site_description]);

        if($request->hasFile('logo_small')){
            $logo_small = uploadPhoto($request->file('logo_small'), 'setting');
            Setting::where('key', 'logo_small')->update(['value' => $logo_small]);
        }

        if($request->hasFile('logo_large')){
            $logo_large = uploadPhoto($request->file('logo_large'), 'setting');
            Setting::where('key', 'logo_large')->update(['value' => $logo_large]);
        }


        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diupdate'
        ], 200);
    }
}
