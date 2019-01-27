<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;

class ProfileController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view('profile.index', ['user'=> $user]);
    }

    public function edit() {
        $user = Auth::user();
        return view('profile.edit', ['user'=> $user]);
    }

    public function update(Request $request) {
        \Validator::make($request->all(), [
            "name" => "required|min:5|max:100",
            "phone" => "required|digits_between:10,12",
            "address" => "required|min:20|max:200"
        ])->validate();

        $user = Auth::user();

        $user->name = $request->get('name');
        $user->phone = $request->get('phone');
        $user->address = $request->get('address');

        if($request->file('avatar')) {
            if($user->avatar && file_exists(storage_path('app/public/'.$user->avatar))) {
                \Storage::delete('public/'.$user->avatar);
            }
            $file = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $file;
        }

        $user->save();
        return redirect()->route('profile')->with('status', 'Profile successfully updated.');

    }

    public function changePassword() {
        return view('profile.change-password');
    }

    public function updatePassword(Request $request) {
        \Validator::make($request->all(), [
            "current_password" => "required",
            "new_password" => "required|min:6",
            "password_confirmation" => "required|same:new_password"
        ])->validate();

        $user = Auth::user();

        if(Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->route('profile')->with('status', 'Password successfully changed.');
        } else {
            return redirect()->route('profile.change-password')->with('error', 'Current password is not match.');
        }
    }
}
