<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showCreateUsers()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function addUser(UserLoginRequest $request)
    {
        $data = $request->validated();
        
        // replace password with the hashed version
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('create-users')->with('success', 'New user added successfully');
    }

    public function editUser(User $user)
    {
        return view('users-edit', compact('user'));
    }

    public function updateUser(UpdateUserRequest $request, User $user)
    {
        $user = User::whereId($user->id)->first();
        $data = $request->validated();

        // check if user has filled the password field.
        if(isset($data['password'])) {
            // the user has sent a new password
            // hash the password and set it to password in $data again
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return redirect()->route('create-users');
    }
    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('create-users')->with('success', 'User deleted successfully.');
    }
}
