<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class adminUser extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('backend.User.index', compact('users'));
    }

    public function edit(User $user)
    {

        return view('backend.User.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $form = $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'role' => 'required|string|in:admin,user,editor',
        ]);


        $user->update($form);

        return redirect()->route('backend.user.index')->with('success', 'User updated successfully.');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User delete successfully');
    }
}
