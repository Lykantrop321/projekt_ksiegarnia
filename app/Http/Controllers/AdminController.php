<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get(); // Pobranie użytkowników wraz z rolami
        $roles = Role::all(); // Pobranie wszystkich ról
        return view('admin', compact('users', 'roles')); // Przekazanie do widoku
    }
}
