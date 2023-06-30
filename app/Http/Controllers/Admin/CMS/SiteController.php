<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $settings = \App\Models\Setting::all();

        return view('admin.cms.site', compact('settings'));
    }

    public function update(Request $request){
        
    }
}
