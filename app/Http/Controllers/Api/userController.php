<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        if ($users->count() > 0) {
            return response()->json([
                'status' => 200,
                'users' => $users
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Records Found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'login' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'email' => 'required|string|email|max:255|unique:users',
            'enabled' => 'boolean',
            'notification' => 'nullable|string',
            'userable_type' => 'nullable|string|max:255',
            'userable_id' => 'nullable|integer',
            'google_id' => 'nullable|string',
            'authentication_provider' => 'nullable|string',
            'profile_photo_path' => 'nullable|string|max:2048',
            'current_team_id' => 'nullable|integer',
            'is_super_admin' => 'boolean',
            'comment' => 'nullable|string',
        ]);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        // Create new user instance
        $user = User::create(array_merge(
            $request->except('password'),
            ['password' => Hash::make($request->password)]
        ));

        // Return success response with the created user data
        return response()->json([
            'status' => 201,
            'message' => 'User created successfully',
            'user' => $user
        ], 201);
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json([
                'status' => 200,
                'user' => $user
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such user found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'login' => 'string|max:255|unique:users,login,' . $id,
            'password' => 'string|min:8',
            'email' => 'string|email|max:255|unique:users,email,' . $id,
            'enabled' => 'boolean',
            'notification' => 'nullable|string',
            'userable_type' => 'nullable|string|max:255',
            'userable_id' => 'nullable|integer',
            'google_id' => 'nullable|string',
            'authentication_provider' => 'nullable|string',
            'profile_photo_path' => 'nullable|string|max:2048',
            'current_team_id' => 'nullable|integer',
            'is_super_admin' => 'boolean',
            'comment' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        $data = $request->except('password');
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json([
            'status' => 200,
            'message' => 'User updated successfully',
            'user' => $user
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json([
                'status' => 200,
                'message' => 'User deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such user found'
            ], 404);
        }
    }
}
