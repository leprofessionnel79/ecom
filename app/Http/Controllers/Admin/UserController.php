<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_as','!=','2')->paginate(10);
        return view('admin.users.index',compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $locale = app()->getLocale();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role_as' => ['required', 'integer'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as
        ]);

        if($locale=='ar'){
            return redirect('/admin/users')->with('message','تم إنشاء المستخدم بنجاح');
        }
        return redirect('/admin/users')->with('message','User Created Successfully');
    }

    public function edit(int $userId)
    {
        $user = User::findOrFail($userId);
        return view('admin.users.edit',compact('user'));

    }

    public function update(Request $request,int $userId)
    {
        $locale = app()->getLocale();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'role_as' => ['required', 'integer'],
        ]);

        User::findOrFail($userId)->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as
        ]);

        if($locale=='ar'){
            return redirect('/admin/users')->with('message','تم تحديث المستخدم بنجاح');
        }
        return redirect('/admin/users')->with('message','User Updated Successfully');
    }

    public function destroy(int $userId)
    {
        $locale = app()->getLocale();

        $user = User::findOrFail($userId);
        $user->delete();

        if($locale=='ar'){
            return redirect('/admin/users')->with('message','تم حذف المستخدم بنجاح');
        }
        return redirect('/admin/users')->with('message','User Deleted Successfully');
    }
}
