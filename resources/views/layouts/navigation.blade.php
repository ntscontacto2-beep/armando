<nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom border-secondary">
  <div class="container">
    <a class="navbar-brand text-uppercase fw-bold" href="{{ url('/') }}" style="letter-spacing:2px;">
        Tianguis <span style="color:#f0a500;">SMT</span>
    </a>

    <button class="navbar-toggler rounded-0" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div id="nav" class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        {{-- INICIO --}}
        <li class="nav-item">
            <a class="nav-link text-uppercase small {{ request()->routeIs('dashboard') || request()->routeIs('locales.index') ? 'active fw-bold text-white' : '' }}"
               href="{{ route('locales.index') }}">
               Negocios
            </a>
        </li>

        {{-- RUTAS --}}
        <li class="nav-item">
            <a class="nav-link text-uppercase small {{ request()->routeIs('rutas.index') ? 'active fw-bold text-white' : '' }}"
               href="{{ route('rutas.index') }}">
                Rutas
            </a>
        </li>

        {{-- HISTORIA --}}
        <li class="nav-item">
            <a class="nav-link text-uppercase small {{ request()->routeIs('historia.index') ? 'active fw-bold text-white' : '' }}"
               href="{{ route('historia.index') }}">
                Historia
            </a>
        </li>

        {{-- SOLO PARA USUARIOS LOGUEADOS --}}
        @auth
        <li class="nav-item">
            <a class="nav-link text-uppercase small {{ request()->routeIs('locales.create') ? 'active fw-bold text-white' : '' }}"
               href="{{ route('locales.create') }}">
                + Negocio
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-uppercase small {{ request()->routeIs('vendedores.*') ? 'active fw-bold text-white' : '' }}"
               href="{{ route('vendedores.index') }}">
                Vendedores
            </a>
        </li>
        @endauth

      </ul>

      {{-- SECCIÓN DERECHA --}}
      @auth
        <div class="d-flex align-items-center gap-2">
            <span class="text-white small text-uppercase d-none d-lg-inline border-end border-secondary pe-3" style="opacity:.7;">
                {{ Auth::user()->name }}
            </span>
            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-secondary rounded-0 text-uppercase fw-bold d-none d-lg-inline-block" style="font-size:.7rem;">
                Perfil
            </a>
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light rounded-0 text-uppercase fw-bold" style="font-size:.7rem;">
                    Salir
                </button>
            </form>
        </div>
      @else
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light rounded-0 text-uppercase fw-bold" style="font-size:.7rem;">
                Iniciar Sesión
            </a>
            <a href="{{ route('register') }}" class="btn btn-sm rounded-0 text-uppercase fw-bold text-dark" style="background:#f0a500; font-size:.7rem;">
                Registrarse
            </a>
        </div>
      @endauth

    </div>
  </div>
</nav>
