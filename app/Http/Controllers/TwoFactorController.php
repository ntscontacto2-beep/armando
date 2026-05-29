<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


class TwoFactorController extends Controller
{
    public function index()
    {
        return view('auth.two_factor');
    }

    public function store(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'integer|required',
        ]);

        $user = auth()->user();

        if ($request->two_factor_code == $user->two_factor_code) {
            $user->resetTwoFactorCode();
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['two_factor_code' => 'El código ingresado es incorrecto.']);
    }

    public function resend()
    {
        $user = auth()->user();
        $user->generateTwoFactorCode();

      
        Mail::send('emails.two_factor', ['code' => $user->two_factor_code], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Tu Código de Verificación - Tianguis SMT');
        });

        return back()->with('success', 'Se ha reenviado el código a tu correo.');
    }
}