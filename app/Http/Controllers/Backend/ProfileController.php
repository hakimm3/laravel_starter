<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(){
        return view('profile.edit');
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;

        return response()->json([
            'message' => 'Profile updated successfully',
        ], 200);
    }
}
