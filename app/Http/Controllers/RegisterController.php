<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RegisterController extends Controller
{
  public function show()
    {
        return view('register'); // Blade yang kamu buat
    }

    public function register(Request $request)
    {
        // Validasi data
      $validated = $request->validate([
        'username' => 'required|string|max:30|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ], [
        'username.unique' => 'Username telah digunakan.',
        'email.unique' => 'Email telah digunakan.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ]);

    // Simpan user baru ke database dengan role default 'user'
      User::create([
        'username' => $validated['username'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => 'user', // <-- Tidak diambil dari input, tapi diset default
    ]);


        // Redirect setelah sukses register
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }
}
