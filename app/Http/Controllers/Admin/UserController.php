<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\InputUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->when(request()->q, function($users){
            $users = $users->where('name', 'like', '%'.request()->q.'%');
        })->paginate(10);

        return view('pages.admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('pages.admin.user.create');
    }

    public function store(InputUserRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        if($user)
        {
            return redirect()->route('admin.users.index')->with('success', 'Data Berhasil Disimpan');
        }
        else{
            return redirect()->route('admin.users.index')->with('error', 'Data Gagal Disimpan');
        }
    }

    public function edit(User $user)
    {
        return view('pages.admin.user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        $data_user = User::findOrFail($user->id);
        if($request->password == "")
        {
            $data_user->update([
                'name' => $data['name'],
                'email' => $data['email']
            ]);
        }
        else{
            $data_user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]);
        }

        if($user)
        {
            return redirect()->route('admin.users.index')->with('success', 'Data Berhasil Diperbarui');
        }
        else{
            return redirect()->route('admin.users.index')->with('error', 'Data Gagal Diperbarui');
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if($user)
        {
            return response()->json([
                'status' => 'success'
            ]);
        }
        else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
