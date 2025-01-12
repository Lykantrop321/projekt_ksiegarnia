<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure the user is authenticated
    }

    // Display a listing of users
    public function index()
    {
        $users = User::with('roles')->get(); // Eager load roles of users
        return view('user_management.index', compact('users'));
    }

    // Show the form for creating a new user
    public function create()
    {
        $roles = Role::all(); // Get all roles
        return view('user_management.create', compact('roles'));
    }

    // Store a newly created user in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles' => 'required|array',
        ]);

        $user = new User([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $user->save();
        $user->assignRole($validatedData['roles']);

        return redirect()->route('user_management.index')->with('success', 'User created successfully');
    }

    // Show the form for editing the specified user
    public function edit($id)
    {
        $user = User::findOrFail($id); // Find user or fail
        $roles = Role::all(); // Get all roles
        return view('user_management.edit', compact('user', 'roles'));
    }

    // Update the specified user in storage
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required|array',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email']));
    
        // Pobranie nazw roli na podstawie przesłanych ID
        $roles = Role::whereIn('id', $request->roles)->pluck('name');
        $user->syncRoles($roles);
    
        return redirect()->route('user_management.index')->with('success', 'User updated successfully');
    }
    

    // Remove the specified user from storage
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user_management.index')->with('success', 'User deleted successfully');
    }
}
