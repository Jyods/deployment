<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Http\Resources\UserResource;

use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only(['identification', 'password']))) {
            $user = Auth::user();
            //check if user is active
            if (!$user->isActive) {
                return response()->json(['message' => 'User is not active'], 401);
            }
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['token' => $token], 200);
            //return ['token' => $request->user()->createToken('auth_token')->plainTextToken];
        }
        return response()->json(['message' => 'Wrong username or password'], 401);
    }
    public function checkAuth(Request $request)
    {
        if($request->user() == null) {
            return response()->json(['message' => 'Please login'], 401);
        }
        //return $request->user(); and status code 200
        $user = $request->user();
        //check if user is activ
        if (!$user->isActive) {
            return response()->json(['message' => 'User is not active'], 401);
        }
        return new UserResource($user);
    }
    public function checkDepartment(string $department, Request $request)
    {
        $user = $request->user();
        if ($user->department != $department && $user->department != 'Admin') {
            return response()->json(['message' => 'You are not allowed to access this department'], 401);
        }
        return response()->json(['message' => 'You are allowed to access this department'], 200);
    }
    public function showLogin()
    {
        return response()->json(['message' => 'Please login'], 401);
    }
    public function secureSite()
    {
        return response()->json(['message' => 'You are logged in'], 200);
    }
    public function getRestrictionClass(Request $request)
    {
        $user = $request->user();
        $permissions = [
            'restrictionClass' => $user->restrictionClass,
            'permissions' => [
                'permission_register' => $user->permission_register,
                'permission_creator' => $user->permission_creator,
                'permission_recruiter' => $user->permission_recruiter,
                'permission_brodcaster' => $user->permission_broadcaster,
                'permission_admin' => $user->permission_admin,
                'permission_superadmin' => $user->permission_superadmin,
                'permission_allchat' => $user->permission_allchat,
            ]
        ];
        return response()->json(['data' => $permissions], 200);
    }
    public static function getUser() {
        $user = Auth::user();
        return $user;
    }
    public function register(Request $request) {
        $user = new User();
        $user->name = $request->identification ?? 'no name';
        $user->email = $request->email ?? 'no email';
        //hash password
        $user->password = bcrypt($request->password) ?? 'no password';
        $user->identification = $request->identification ?? 'no identification';
        $user->isActive = $request->isActive ?? true;
        $user->restrictionClass = $request->restrictionClass ?? 1;
        //get rank_id from rank object
        $user->rank_id = $request->rank_id;
        $user->save();
        //versuche email zu senden, wenn es nicht geht, dann ist es nicht schlimm
        try {
            Mail::to($request->email)->send(new WelcomeEmail($request->identification, $request->password, $request->creator_name));
        } catch (\Throwable $th) {
            //throw $th;
        }
        return new UserResource($user);
    }
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out'], 200);
    }
    public function switchActive(int $id) {
        $user = User::find($id);
        $user->isActive = !$user->isActive;
        $user->save();
        return new UserResource($user);
    }
}
