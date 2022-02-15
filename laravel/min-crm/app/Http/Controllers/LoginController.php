<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller {
    public function login(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'email'    => 'required|exists:users,email',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                session(['auth_email' => Auth::user()->email]);
//                $user = Auth::user();
                return \redirect()->route('dashboard');
            }else{
                return back()->withErrors(['error' => 'Invalid Cardentials']);
            }
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'data' => 'Interval Server Error'], 500);
        }
    }

    public function register(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'fname'    => 'required|string',
                'lname'    => 'required|string',
                'email'    => 'required|email',
                'password' => 'required|min:4|max:8|confirmed',
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            $userData = [
                'fname'    => $request->fname,
                'lname'    => $request->lname,
                'password' => Hash::make($request->password),
                'email'    => $request->email,
            ];
            $user = User::create($userData);
            if ($user) {
                return redirect()->route('index');
            }
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'data' => 'Interval Server Errorr'], 500);
        }
    }

    public function getDashboardData(){
        $user = Auth::user();
        return view('dashboard',compact('user'));
    }

    public function logout(): \Illuminate\Http\RedirectResponse {
        Session::flush();
        Auth::logout();
        return redirect()->route('index');
    }
}
