<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Credenciales incorrectas.'], 401);
        }

        $user = Auth::user();
        $user->generateTwoFactorCode();

        Mail::send('emails.two_factor', ['code' => $user->two_factor_code], function ($m) use ($user) {
            $m->to($user->email);
            $m->subject('Tu Código de Verificación - Tianguis SMT');
        });

        return response()->json([
            'message'          => 'Código 2FA enviado a tu correo.',
            'two_factor_required' => true,
            'email'            => $user->email,
        ]);
    }

    public function verifyTwoFactor(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code'  => 'required|integer',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado.'], 404);
        }

        if ($request->code != $user->two_factor_code) {
            return response()->json(['message' => 'Código incorrecto.'], 422);
        }

        if ($user->two_factor_expires_at && now()->gt($user->two_factor_expires_at)) {
            return response()->json(['message' => 'El código ha expirado.'], 422);
        }

        $user->resetTwoFactorCode();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => ['id' => $user->id, 'name' => $user->name, 'email' => $user->email],
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Sesión cerrada.']);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
