<?php

namespace App\Http\Controllers;

use App\Http\Requests\importUserRequest;
use App\Imports\UsersImport;
use App\Models\User;
use App\Traits\BaseServiceAndRepoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PHPUnit\Exception;

class UserController extends Controller {
    use BaseServiceAndRepoTrait;

    public function updateUserProfile(Request $request) {
        try {
            $user = Auth::user();
            $path = $user->avatar;
            if ($request->avatar) {
                $file = $request->avatar;
                $path = $file->storeAs('bucket', time() . $file->getClientOriginalName(), 'public');
            }
            if ($request->has('remove')) {
                $path = '';
            }
            User::whereId($user->id)->update([
                'fname'  => $request->input('fname', $user->fname),
                'lname'  => $request->input('lname', $user->lname),
                'avatar' => $path,
            ]);

            return redirect()->route('dashboard');
        } catch (Exception $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'error' => $exception->getTrace(),], 500);
        }
    }

    public function getAllUsers() {
        $users = User::all();
        return view('user_list', compact('users'));
    }

    public function importUser(ImportUserRequest $request) {
        try {
            DB::beginTransaction();
//            $data = Excel::import(new UsersImport, request()->file('file'));
            $data = Excel::toArray(new UsersImport, request()->file('file'));
//            dd($data);
            $users = array();
            foreach ($data[0] as $userData) {
                $userData['password'] = Hash::make($userData['email']);
                $users[] = $userData;
            }
            User::insert($users);
            $usersCount = count($users);
            Session::flash('usersCount', $usersCount);
            DB::commit();
            return view('import_user', compact('usersCount'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $exception) {
            $failures = $exception->failures();
            $errorMsg = [];
            foreach ($failures as $failure) {
                $errorMsg[] = $failure->toArray();
            }
            return redirect()->route('import-view')->with('errorMsg', $errorMsg);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' => $exception->getMessage(), 'error' => $exception->getTrace()], 500);
        }
    }

    public function addUsers(Request $request): \Illuminate\Http\JsonResponse {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
                'user'         => 'required|array',
                'user.*.fname' => 'required|string',
                'user.*.lname' => 'required|string',
                'user.*.email' => 'required|email|unique:users,email',
            ]);
            if ($validator->fails()){
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            }
            $users = $request->input('user');
            foreach ($users as $user) {
                $dataToInsert[] = [
                    'fname' => $user['fname'],
                    'lname' => $user['lname'],
                    'email' => $user['email'],
                    'password' => Hash::make($user['email']),
                ];
            }
            $data = User::insert($dataToInsert);
            if ($data) {
                $newUsers = count($users);
                foreach ($users as $user){
                    $this->baseServices()->emailService->sendWelcomeEmail($user);
                }
            }

            DB::commit();
            Session::flash('manualUsersCount',$newUsers);
            return response()->json(['status' => 200, 'created_users_count'=>$newUsers]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => false, 'error' => $exception->getTrace(), 'msg' => $exception->getMessage()], 500);
        }
    }
}
