<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception;

class UserController extends Controller
{
    public function updateUserProfile(Request $request) {
        try {

            $user = Auth::user();
            $path = $user->avatar;
            if ($request->avatar) {
                $file = $request->avatar;
                $path = $file->storeAs('bucket', time() . $file->getClientOriginalName(),'public');
            }
            if ($request->has('remove')){
                $path = '';
            }
            User::whereId($user->id)->update([
                'fname' => $request->input('fname',$user->fname),
                'lname' => $request->input('lname',$user->lname),
                'avatar' => $path,
            ]);

            return redirect()->route('dashboard');
        } catch (Exception $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(),'error' => $exception->getTrace(),], 500);
        }
    }
}
