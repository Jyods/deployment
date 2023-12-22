<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\File;

use App\Mail\UpdateEmail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        //return UserResource::collection($user) but sort by rank desc
        return UserResource::collection($user->sortByDesc('rank_id'));
        
    }
    public function id(int $id)
    {
        //return User and all files that belong to User
        $user = User::find($id);
        $files = File::where('user_id', $id)->get();
        return new UserResource($user, $files);
    }
    public function store(Request $request)
    {

        $department = $request->department;

        $requester = $request->user();

        if ($requester->department != $department && $requester->department != 'Admin') {
            return response()->json(['message' => 'You are not allowed to create a user for this department'], 401);
        }

        $user = new User();
        $user->email = $request->email;
        $user->password = $request->password;
        $user->identification = $request->identification;
        $user->isActive = $request->isActive;
        $user->restrictionClass = $request->restrictionClass;
        $user->save();
        return new UserResource($user);
    }
    public function update(Request $request)
    {

        $department = $request->department;

        $requester = $request->user();

        if ($requester->department != $department && $requester->department != 'Admin') {
            return response()->json(['message' => 'You are not allowed to update a user for this department'], 401);
        }

        $permissions = $request->permissions;
        foreach ($permissions as $key => $value) {
            if ($value == true) {
                $permissions[$key] = 1;
            } else {
                $permissions[$key] = 0;
            }
        }
        $old_values = User::find($request->id);
        $user = User::find($request->id);
        $user->email = $request->email ?? $user->email;
        $user->password = $request->password ?? $user->password;
        $user->identification = $request->identification ?? $user->identification;
        $user->isActive = $request->isActive ?? $user->isActive;
        $user->restrictionClass = $request->restrictionClass ?? $user->restrictionClass;
        $user->rank_id = $request->rank_id ?? $user->rank_id;
        $user->department = $request->department ?? $user->department;
        $user->permission_register = $permissions['permission_register'] ?? $user->permission_register;
        $user->permission_creator = $permissions['permission_creator'] ?? $user->permission_creator;
        $user->permission_recruiter = $permission['permission_recruiter'] ?? $user->permission_recruiter;
        $user->permission_broadcaster = $permissions['permission_broadcaster'] ?? $user->permission_broadcaster;
        $user->permission_allchat = $permissions['permission_allchat'] ?? $user->permission_allchat;
        $user->save();
        try {
            Mail::to($user->email)->send(new UpdateEmail($old_values, $user, $request->user()->identification));
        } catch (\Throwable $th) {
            //throw $th;
        }
        return new UserResource($user);
    }
}
