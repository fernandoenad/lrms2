<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Download;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
        $users_f =  User::where('status', '=', 0)
            ->paginate(15);
        $managers_c = $this->getRoleCount(2)->count();
        $staff_c = $this->getRoleCount(3)->count();
        $users_c = $this->getRoleCount(4)->count();

        return view('admin.users.index', compact('users_f', 'managers_c', 'staff_c', 'users_c'));       
    }

    public function search()
    {
        $str = request()->str;
        $users_f = User::where('role', '!=', 1)
            ->where(function ($query) use ($str){
                    $query->where('name', 'like', '%'. $str . '%')
                        ->orWhere('username', 'like', '%' . $str . '%')
                        ->orWhere('email', 'like', '%' . $str . '%');
                })
            ->paginate(15);
        $managers_c = $this->getRoleCount(2)->count();
        $staff_c = $this->getRoleCount(3)->count();
        $users_c = $this->getRoleCount(4)->count();

        return view('admin.users.index', compact('users_f', 'managers_c', 'staff_c', 'users_c'));
    }

    public function edit(User $user)
    {
        $users = $this->getUsers();
        $users_f = $users->paginate(15);
        $managers_c = $this->getRoleCount(2)->count();
        $staff_c = $this->getRoleCount(3)->count();
        $users_c = $this->getRoleCount(4)->count();

        $services = $this->getUsers()->orderBy('service', 'asc')
            ->groupBy('service')   
            ->select('service')         
            ->get();
    
        $districts = $this->getUsers()->orderBy('district', 'asc')
            ->groupBy('district')     
            ->select('district')       
            ->get();

        return view('admin.users.index', compact('users_f', 'managers_c', 'staff_c', 'users_c', 'user', 'services', 'districts'));
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'min:3', 'max:255', Rule::unique('users')->ignore($user->id)],
            'username' => ['required', 'string', 'min:3', 'max:255', Rule::unique('users')->ignore($user->id)],
            'service' => ['required', 'string', 'min:3', 'max:255'],
            'district' => ['required', 'string', 'min:3', 'max:255'],
            'role' => ['required'],
            ]);

        $user->update($data);

        return redirect()->route('admin.users.edit', compact('user'))->with('status', 'User was updated successfully.');
    }

    public function create()
    {
        $users = $this->getUsers();
        $users_f = $users->paginate(15);
        $managers_c = $this->getRoleCount(2)->count();
        $staff_c = $this->getRoleCount(3)->count();
        $users_c = $this->getRoleCount(4)->count();

        $services = User::orderBy('service', 'asc')
            ->groupBy('service')   
            ->select('service')         
            ->get();
        
        $districts = User::orderBy('district', 'asc')
            ->groupBy('district')     
            ->select('district')
            ->get();

        return view('admin.users.index', compact('users_f', 'managers_c', 'staff_c', 'users_c', 'services', 'districts'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'min:3', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'min:3', 'max:255', 'unique:users'],
            'service' => ['required', 'string', 'min:3', 'max:255'],
            'district' => ['required', 'string', 'min:3', 'max:255'],
            'role' => ['required'],
            ]);   
        
        $user = User::create(array_merge($data, [
            'password' => Hash::make($data['username']),
            'image' => 'avatars/no-avatar.jpg',
            'status' => 1,
        ]));    

        return redirect()->route('admin.users.edit', compact('user'))->with('status', 'User was created successfully.');
    }

    public function disable(User $user)
    {
        $users = $this->getUsers();
        $users_f = $users->paginate(15);
        $managers_c = $this->getRoleCount(2)->count();
        $staff_c = $this->getRoleCount(3)->count();
        $users_c = $this->getRoleCount(4)->count();

        return view('admin.users.index', compact('users_f', 'managers_c', 'staff_c', 'users_c', 'user'));
    }

    public function disabled(User $user)
    {
        
        $user->update(['status' => 0]);    

        return redirect()->route('admin.users')->with('status', 'User was deactivated successfully.');
    }

    public function reset(User $user)
    {
        $users = $this->getUsers();
        $users_f = $users->paginate(15);
        $managers_c = $this->getRoleCount(2)->count();
        $staff_c = $this->getRoleCount(3)->count();
        $users_c = $this->getRoleCount(4)->count();

        return view('admin.users.index', compact('users_f', 'managers_c', 'staff_c', 'users_c', 'user'));
    }

    public function resetted(User $user)
    {
        
        $user->update([
            'status' => 1,
            'password' => Hash::make($user->username),
            ]);    

        return redirect()->route('admin.users.edit', compact('user'))->with('status', 'Account reset was successful.');
    }

    public function logs(User $user)
    {
        $logs = Download::where('user_id', '=', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.users.logs', compact('user', 'logs'));
    }
}
