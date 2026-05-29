@extends('layouts.app')

@section('content')

{{-- HERO --}}
<div class="bg-black text-white overflow-hidden" style="min-height:460px; display:flex; align-items:center;">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <small class="d-block mb-3 fw-bold text-uppercase" style="letter-spacing:4px; color:#f0a500; font-size:.7rem;">
                    San Martín Texmelucan, Puebla
                </small>
                <h1 class="fw-black text-uppercase mb-3" style="font-size:clamp(2.8rem,7vw,5.5rem); line-height:1; letter-spacing:-2px;">
                    Tianguis<br><span style="color:#f0a500;">SMT</span>
                </h1>
                <p class="mb-4" style="max-width:480px; color:#888; font-size:.95rem; line-height:1.7;">
                    El mercado tradicional más grande de la región. Cientos de negocios de ropa, calzado, comida y más — todos los martes y fines de semana.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('locales.index') }}"
                       class="btn btn-lg rounded-0 fw-bold text-uppercase px-5 text-dark"
                       style="background:#f0a500; letter-spacing:1px;">
                        <i class="bi bi-shop me-2"></i>Ver Negocios
                    </a>
                    <a href="{{ route('rutas.index') }}"
                       class="btn btn-lg rounded-0 fw-bold text-uppercase px-4"
                       style="border:1px solid #444; color:#ccc; letter-spacing:1px;">
                        <i class="bi bi-map me-2"></i>Cómo Llegar
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center">
                <div style="border:1px solid #222; padding:2.5rem; text-align:center; max-width:280px; width:100%;">
                    <i class="bi bi-building" style="font-size:4rem; color:#f0a500; opacity:.5; display:block; margin-bottom:1rem;"></i>
                    <div style="border-top:1px solid #222; padding-top:1rem;">
                        <p class="text-uppercase fw-bold mb-0" style="font-size:.65rem; letter-spacing:3px; color:#555;">Plataforma Digital</p>
                        <p class="fw-black mb-0" style="font-size:1.8rem; color:#f0a500;">SMT</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- STATS --}}
<div class="border-top border-bottom" style="background:#111; border-color:#222 !important;">
    <div class="container py-4">
        <div class="row text-center g-0">
            <div class="col-6 col-md-3 py-2" style="border-right:1px solid #222;">
                <div class="fw-black" style="font-size:2rem; color:#f0a500;">500+</div>
                <small class="text-uppercase" style="font-size:.6rem; letter-spacing:2px; color:#555;">Locales</small>
            </div>
            <div class="col-6 col-md-3 py-2" style="border-right:1px solid #222;">
                <div class="fw-black" style="font-size:2rem; color:#f0a500;">5</div>
                <small class="text-uppercase" style="font-size:.6rem; letter-spacing:2px; color:#555;">Categorías</small>
            </div>
            <div class="col-6 col-md-3 py-2" style="border-right:1px solid #222;">
                <div class="fw-black" style="font-size:2rem; color:#f0a500;">2</div>
                <small class="text-uppercase" style="font-size:.6rem; letter-spacing:2px; color:#555;">Días de Tianguis</small>
            </div>
            <div class="col-6 col-md-3 py-2">
                <div class="fw-black" style="font-size:2rem; color:#f0a500;">1</div>
                <small class="text-uppercase" style="font-size:.6rem; letter-spacing:2px; color:#555;">Plataforma Digital</small>
            </div>
        </div>
    </div>
</div>

{{-- CATEGORÍAS --}}
<div class="container py-5 my-2">
    <div class="text-center mb-5">
        <small class="text-uppercase fw-bold d-block mb-2" style="font-size:.65rem; letter-spacing:3px; color:#f0a500;">Directorio</small>
        <h2 class="fw-black text-uppercase mb-1" style="letter-spacing:-1px;">Explora por Categoría</h2>
        <p class="text-muted mb-0" style="font-size:.9rem;">Encuentra exactamente lo que buscas</p>
    </div>
    <div class="row g-3 justify-content-center">
        @php
            $cats = [
                ['nombre' => 'Ropa',        'icono' => 'bi-handbag'],
                ['nombre' => 'Calzado',     'icono' => 'bi-bag'],
                ['nombre' => 'Comida',      'icono' => 'bi-cup-hot'],
                ['nombre' => 'Accesorios',  'icono' => 'bi-gem'],
                ['nombre' => 'Electrónica', 'icono' => 'bi-cpu'],
            ];
        @endphp
        @foreach($cats as $cat)
        <div class="col-6 col-sm-4 col-lg-2">
            <a href="{{ route('locales.index', ['categoria' => $cat['nombre']]) }}" class="text-decoration-none">
                <div class="text-center p-4 h-100 position-relative overflow-hidden cat-card"
                     style="border:1px solid #e0e0e0; border-bottom:3px solid #f0a500; transition:all .15s; background:#fff;">
                    <i class="bi {{ $cat['icono'] }} d-block mb-2" style="font-size:1.8rem; color:#111;"></i>
                    <span class="fw-bold text-uppercase text-dark" style="font-size:.72rem; letter-spacing:1px;">{{ $cat['nombre'] }}</span>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

{{-- CÓMO FUNCIONA --}}
<div class="py-5" style="background:#f9f9f9; border-top:1px solid #eee; border-bottom:1px solid #eee;">
    <div class="container">
        <div class="text-center mb-5">
            <small class="text-uppercase fw-bold d-block mb-2" style="font-size:.65rem; letter-spacing:3px; color:#f0a500;">Proceso</small>
            <h2 class="fw-black text-uppercase mb-1" style="letter-spacing:-1px;">¿Cómo funciona?</h2>
            <p class="text-muted mb-0" style="font-size:.9rem;">Todo lo que necesitas en un solo lugar</p>
        </div>
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="p-4" style="border-top:3px solid #f0a500;">
                    <i class="bi bi-search d-block mb-3" style="font-size:2rem; color:#111;"></i>
                    <h5 class="fw-bold text-uppercase" style="font-size:.85rem; letter-spacing:1px;">Busca un Negocio</h5>
                    <p class="text-muted mb-0" style="font-size:.82rem;">Filtra por categoría o busca por nombre. Encuentra el local que necesitas en segundos.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4" style="border-top:3px solid #f0a500;">
                    <i class="bi bi-pin-map d-block mb-3" style="font-size:2rem; color:#111;"></i>
                    <h5 class="fw-bold text-uppercase" style="font-size:.85rem; letter-spacing:1px;">Ubícalo en el Mapa</h5>
                    <p class="text-muted mb-0" style="font-size:.82rem;">Cada local tiene su ubicación exacta en Google Maps. Sin perderte.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4" style="border-top:3px solid #f0a500;">
                    <i class="bi bi-telephone d-block mb-3" style="font-size:2rem; color:#111;"></i>
                    <h5 class="fw-bold text-uppercase" style="font-size:.85rem; letter-spacing:1px;">Contacta al Vendedor</h5>
                    <p class="text-muted mb-0" style="font-size:.82rem;">Ve el teléfono y datos del vendedor directamente desde la plataforma.</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CTA --}}
<div class="py-5 text-center" style="background:#111;">
    <div class="container py-3">
        <small class="text-uppercase fw-bold d-block mb-2" style="font-size:.65rem; letter-spacing:3px; color:#f0a500;">Únete</small>
        <h2 class="fw-black text-uppercase text-white mb-2" style="font-size:clamp(1.5rem,4vw,2.5rem); letter-spacing:-1px;">
            ¿Tienes un negocio aquí?
        </h2>
        <p class="mb-4" style="color:#555; font-size:.9rem;">Regístralo en la plataforma y llega a más clientes.</p>
        @auth
            <a href="{{ route('locales.create') }}"
               class="btn btn-lg rounded-0 fw-bold text-uppercase px-5 text-dark"
               style="background:#f0a500; letter-spacing:1px;">
                <i class="bi bi-plus-circle me-2"></i>Registrar mi Negocio
            </a>
        @else
            <a href="{{ route('login') }}"
               class="btn btn-lg rounded-0 fw-bold text-uppercase px-5 text-dark"
               style="background:#f0a500; letter-spacing:1px;">
                <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión para Registrar
            </a>
        @endauth
    </div>
</div>

<style>
.cat-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,.1); }
.cat-card:hover i { color: #f0a500 !important; }
</style>

@endsection
