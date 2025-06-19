<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'username' => 'required|unique:users',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => $request->role ?? 'user',
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan');
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required',
            'username' => 'required|unique:users,username,' . $user->id,
            'email'    => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name', 'username', 'email', 'role'));

        return redirect()->back()->with('success', 'User berhasil diupdate');
    }

    // Hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
}
