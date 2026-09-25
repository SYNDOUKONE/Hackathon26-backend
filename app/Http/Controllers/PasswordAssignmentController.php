<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class PasswordAssignmentController extends Controller
{
    public function show()
    {
        return view('password-assignment');
    }

    public function assign(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        if (Auth::check()) {
            $user = Auth::user();
            $user->password = Hash::make($request->password);
            $user->save();

            Auth::logout();

            return redirect()->route('login')->with('success', 'Mot de passe mis à jour avec succès. Vous pouvez maintenant vous connecter.');
        }

        return redirect()->route('login')->with('error', 'Session expirée, veuillez vous reconnecter.');
    }
}
