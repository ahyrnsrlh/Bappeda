<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function showLogin()
    {
        return Inertia::render('Auth/Login', [
            'message' => session('message'),
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        
        // Cek apakah user ada dan password benar
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();
            
            // Cek apakah user sudah diapprove
            if (!$user->is_approved) {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => 'Akun Anda belum disetujui oleh Kepala Bidang. Silakan tunggu persetujuan untuk dapat mengakses sistem.',
                ]);
            }
            
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function showRegister()
    {
        $teams = Team::all();
        
        return Inertia::render('Auth/Register', [
            'teams' => $teams
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:kabid,wakabid,KI,tim_1,tim_2,tim_3,tim_4,tim_5,tim_kemiskinan,tim_industri_psn,tim_investasi,tim_csr,tim_dbh',
            'team_id' => 'nullable|exists:teams,id',
        ]);

        // Tentukan apakah user perlu approval
        $needsApproval = !in_array($request->role, ['kabid']); // kabid tidak perlu approval
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'team_id' => $request->team_id,
            'is_approved' => !$needsApproval, // kabid langsung approved
            'approved_at' => !$needsApproval ? now() : null,
        ]);

        if ($needsApproval) {
            // Jangan langsung login, redirect ke halaman menunggu approval
            return redirect('/login')->with('message', 'Akun Anda telah dibuat. Silakan tunggu persetujuan dari Kepala Bidang untuk dapat mengakses sistem.');
        } else {
            // Kabid langsung login
            Auth::login($user);
            return redirect('/dashboard');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
