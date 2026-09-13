<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Afficher la page de connexion.
     */
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * Connexion administrateur.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => 'admin',
        ])) {
            $request->session()->regenerate();

            return redirect()->intended(
                route('admin.dashboard')
            );
        }

        return back()
            ->withErrors([
                'email' => 'Les identifiants sont incorrects.',
            ])
            ->onlyInput('email');
    }

    /**
     * Afficher la page de création de compte.
     */
    public function showRegister()
    {
        return view('admin.auth.register');
    }

    /**
     * Créer le compte administrateur.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'admin',
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->route('admin.dashboard')
            ->with(
                'success',
                'Votre compte administrateur a été créé avec succès.'
            );
    }

    /**
     * Déconnexion.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}