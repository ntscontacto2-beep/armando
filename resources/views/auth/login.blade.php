<x-guest-layout>
    <style>
        .auth-wrapper {
            background-color: #ffffff !important;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 2.5rem;
            background: #ffffff;
            border-radius: 1rem;
            border: 2px solid #000000;
            box-shadow: 10px 10px 0px #000000;
        }
        .tsmt-input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #000000;
            border-radius: 0.5rem;
            margin-top: 0.5rem;
            outline: none;
        }
        .btn-black {
            background-color: #000000;
            color: white;
            width: 100%;
            padding: 1rem;
            border-radius: 0.5rem;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 1.5rem;
            border: none;
            cursor: pointer;
        }
    </style>

    <div class="auth-wrapper">
        <div class="login-card">
            <h1 class="text-3xl font-bold text-center mb-6">LOGIN SMT</h1>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4 text-left">
                    <label class="font-bold">CORREO ELECTRÓNICO</label>
                    <input id="email" class="tsmt-input" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-4 text-left">
                    <label class="font-bold">CONTRASEÑA</label>
                    <input id="password" class="tsmt-input" type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center mb-4">
                    <input id="remember_me" type="checkbox" name="remember" style="accent-color: #000;">
                    <span class="ms-2 text-sm font-bold">RECORDARME</span>
                </div>

                <button type="submit" class="btn-black">
                    ENTRAR AL PANEL
                </button>

                <div class="mt-8 text-center border-t-2 border-black pt-4">
                    <p class="text-sm font-medium mb-2">¿NO TIENES CUENTA?</p>
                    <a href="{{ route('register') }}" class="text-sm font-bold underline hover:text-gray-700">
                        REGÍSTRATE AQUÍ
                    </a>
                </div>

                <div class="mt-4 text-center">
                    @if (Route::has('password.request'))
                        <a class="text-xs underline" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>