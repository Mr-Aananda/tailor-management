<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class PasswordController extends Controller {

    /**
     * Display the password reset view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request) {
        return view('settings.reset-password', ['request' => $request]);
    }

    public function update(Request $request) {
        // dd($request->all());

        if(Hash::check($request->current_password, Auth::user()->password)) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            // update
            Auth::user()->update([
                'password' => Hash::make($request->password),
            ]);

        } else {
            return redirect()->back()->withErrors("Something went wrong!");
        }

        return redirect()->back()->withSuccess("Password has been updated successfully.");
    }
}
