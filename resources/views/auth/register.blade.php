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
        .register-card {
            width: 100%;
            max-width: 450px;
            padding: 2.5rem;
            background: #ffffff;
            border-radius: 1rem;
            border: 2px solid #000000;
            box-shadow: 10px 10px 0px #000000; /* Sombra sólida igual al login */
        }
        .tsmt-input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #000000;
            border-radius: 0.5rem;
            margin-top: 0.5rem;
            outline: none;
            font-weight: 500;
        }
        .tsmt-input:focus {
            background-color: #f0fdf4; /* Un toque de verde muy leve al escribir */
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
            transition: transform 0.1s;
        }
        .btn-black:active {
            transform: translate(2px, 2px);
        }
    </style>

    <div class="auth-wrapper">
        <div class="register-card">
            <h1 class="text-3xl font-bold text-center mb-2">CREAR CUENTA</h1>
            <p class="text-center text-sm font-bold mb-6">ÚNETE AL TIANGUIS SMT</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label class="font-bold text-sm">NOMBRE COMPLETO</label>
                    <input id="name" class="tsmt-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <label class="font-bold text-sm">CORREO ELECTRÓNICO</label>
                    <input id="email" class="tsmt-input" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <label class="font-bold text-sm">CONTRASEÑA</label>
                    <input id="password" class="tsmt-input" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <label class="font-bold text-sm">CONFIRMAR CONTRASEÑA</label>
                    <input id="password_confirmation" class="tsmt-input" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <button type="submit" class="btn-black">
                    REGISTRARME
                </button>

                <div class="mt-8 text-center border-t-2 border-black pt-4">
                    <p class="text-sm font-medium mb-2">¿YA TIENES CUENTA?</p>
                    <a href="{{ route('login') }}" class="text-sm font-bold underline hover:text-gray-700">
                        INICIA SESIÓN AQUÍ
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>