<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $request->authenticate();

 
        $request->session()->regenerate();


        
        $user = auth()->user();
        
    
        $user->generateTwoFactorCode();

     
        try {
            Mail::send('emails.two_factor', ['code' => $user->two_factor_code], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Código de Acceso - Tianguis SMT');
            });
        } catch (\Exception $e) {
     
        }

     
        return redirect()->route('verify.index');


    }

   
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}