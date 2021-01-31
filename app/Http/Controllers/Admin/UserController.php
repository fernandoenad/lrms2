<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = $this->getUsers();
        $users_f = $users->paginate(15);
        $managers_c = $this->getRoleCount(2)->count();
        $staff_c = $this->getRoleCount(3)->count();
        $users_c = $this->getRoleCount(4)->count();

        return view('admin.users.index', compact('users_f', 'managers_c', 'staff_c', 'users_c'));
    }

    public function getUsers()
    {
        $users = User::where('role', '!=', 1)
            ->where('status', '=', 1)
            ->orderBy('role', 'asc')
            ->orderBy('name', 'asc');

        return $users;
    }

    public function getRoleCount($role_id)
    {
        $users = $this->getUsers()
            ->where('role', '=', $role_id);

        return $users;
    }

    public function showInactive()
    {
        $users = $this->getUsers();
        $users_f =  User::where('status', '=', 0)
            ->paginate(15);
        $managers_c = $this->getRoleCount(2)->count();
        $staff_c = $this->getRoleCount(3)->count();
        $users_c = $this->getRoleCount(4)->count();

        return view('admin.users.index', compact('users_f', 'managers_c', 'staff_c', 'users_c'));       
    }
}
