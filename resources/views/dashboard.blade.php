@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="bg-black text-white py-5 border-bottom border-secondary">
    <div class="container">
        <div class="row align-items-center g-3">
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold text-uppercase mb-1" style="letter-spacing:-1px;">Tianguis SMT</h1>
                <p class="text-secondary mb-0" style="letter-spacing:2px; font-size:.78rem;">PLATAFORMA DE GESTIÓN COMERCIAL Y LOGÍSTICA</p>
            </div>
            <div class="col-lg-6">
                <form action="{{ route('dashboard') }}" method="GET" class="d-flex border border-secondary p-1 bg-dark">
                    @if(request('categoria'))
                        <input type="hidden" name="categoria" value="{{ request('categoria') }}">
                    @endif
                    <input type="text" name="q" value="{{ request('q') }}"
                           class="form-control bg-transparent border-0 text-white shadow-none rounded-0"
                           placeholder="BUSCAR LOCAL...">
                    <button class="btn rounded-0 text-uppercase px-4 fw-bold text-dark" style="background:#f0a500;" type="submit">
                        <i class="bi bi-search me-1"></i> Buscar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">

    @if(session('success'))
        <div class="alert rounded-0 border-0 mb-4 text-white" style="background:#1a1a1a;">
            <i class="bi bi-check-circle-fill me-2" style="color:#f0a500;"></i> {{ session('success') }}
        </div>
    @endif

    {{-- ====================== KPIs ====================== --}}
    <div class="row g-3 mb-5">

        <div class="col-6 col-md-3">
            <div class="p-4 h-100 d-flex flex-column justify-content-between position-relative overflow-hidden"
                 style="background:#111; color:#fff; border-left:4px solid #f0a500;">
                <i class="bi bi-shop position-absolute top-0 end-0 m-3"
                   style="font-size:2.8rem; opacity:.08; color:#f0a500;"></i>
                <small class="text-uppercase fw-bold d-block" style="font-size:.62rem; letter-spacing:2px; color:#888;">Total Negocios</small>
                <div class="fw-black my-1" style="font-size:2.8rem; line-height:1; color:#f0a500;">{{ $totalLocales }}</div>
                <small style="font-size:.7rem; color:#666;">registrados en el sistema</small>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="p-4 h-100 d-flex flex-column justify-content-between position-relative overflow-hidden"
                 style="background:#111; color:#fff; border-left:4px solid #f0a500;">
                <i class="bi bi-people-fill position-absolute top-0 end-0 m-3"
                   style="font-size:2.8rem; opacity:.08; color:#f0a500;"></i>
                <small class="text-uppercase fw-bold d-block" style="font-size:.62rem; letter-spacing:2px; color:#888;">Vendedores</small>
                <div class="fw-black my-1" style="font-size:2.8rem; line-height:1; color:#f0a500;">{{ $totalVendedores }}</div>
                <small style="font-size:.7rem; color:#666;">registrados en el sistema</small>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="p-4 h-100 d-flex flex-column justify-content-between position-relative overflow-hidden"
                 style="background:#f0a500; border-left:4px solid #c88a00;">
                <i class="bi bi-door-open-fill position-absolute top-0 end-0 m-3"
                   style="font-size:2.8rem; opacity:.15; color:#000;"></i>
                <small class="text-uppercase fw-bold d-block" style="font-size:.62rem; letter-spacing:2px; color:#6b4a00;">Abiertos Ahora</small>
                <div class="fw-black text-dark my-1" style="font-size:2.8rem; line-height:1;">{{ $abiertos }}</div>
                <small style="font-size:.7rem; color:#6b4a00;">en este momento</small>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="p-4 h-100 d-flex flex-column justify-content-between position-relative overflow-hidden"
                 style="background:#1a1a1a; color:#fff; border-left:4px solid #444;">
                <i class="bi bi-door-closed-fill position-absolute top-0 end-0 m-3"
                   style="font-size:2.8rem; opacity:.08; color:#fff;"></i>
                <small class="text-uppercase fw-bold d-block" style="font-size:.62rem; letter-spacing:2px; color:#888;">Cerrados Ahora</small>
                <div class="fw-black my-1" style="font-size:2.8rem; line-height:1; color:#ccc;">{{ $cerrados }}</div>
                <small style="font-size:.7rem; color:#666;">en este momento</small>
            </div>
        </div>

    </div>

    {{-- ====================== GRÁFICAS ====================== --}}
    <div class="row g-4 mb-5">

        {{-- DONUT --}}
        <div class="col-md-5">
            <div class="h-100" style="border:1px solid #ddd;">
                <div class="px-4 py-3 d-flex align-items-center gap-2" style="background:#111; border-bottom:1px solid #333;">
                    <i class="bi bi-pie-chart-fill" style="color:#f0a500; font-size:1rem;"></i>
                    <span class="fw-bold text-white text-uppercase" style="font-size:.75rem; letter-spacing:1px;">Negocios por Categoría</span>
                </div>
                <div class="p-4 d-flex align-items-center justify-content-center" style="min-height:280px; background:#fff;">
                    @if($porCategoria->isEmpty())
                        <div class="text-center text-muted">
                            <i class="bi bi-bar-chart" style="font-size:2.5rem; opacity:.3;"></i>
                            <p class="small mt-2 mb-0">Sin datos suficientes</p>
                        </div>
                    @else
                        <div style="max-width:250px; width:100%;">
                            <canvas id="graficaCategorias"></canvas>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- BARRAS --}}
        <div class="col-md-7">
            <div class="h-100" style="border:1px solid #ddd;">
                <div class="px-4 py-3 d-flex align-items-center gap-2" style="background:#111; border-bottom:1px solid #333;">
                    <i class="bi bi-bar-chart-fill" style="color:#f0a500; font-size:1rem;"></i>
                    <span class="fw-bold text-white text-uppercase" style="font-size:.75rem; letter-spacing:1px;">Negocios por Días Laborales</span>
                </div>
                <div class="p-4 d-flex align-items-center" style="min-height:280px; background:#fff;">
                    @if($porDias->isEmpty())
                        <div class="text-center text-muted w-100">
                            <i class="bi bi-bar-chart" style="font-size:2.5rem; opacity:.3;"></i>
                            <p class="small mt-2 mb-0">Sin datos suficientes</p>
                        </div>
                    @else
                        <canvas id="graficaDias" style="width:100%;"></canvas>
                    @endif
                </div>
            </div>
        </div>

    </div>

    {{-- ====================== FILTROS ====================== --}}
    <div class="mb-5 pb-4 border-bottom">
        <small class="text-uppercase fw-bold d-block mb-3" style="font-size:.65rem; letter-spacing:2px; color:#888;">
            <i class="bi bi-funnel-fill me-1" style="color:#f0a500;"></i> Filtrar por Categoría
        </small>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('dashboard') }}"
               class="btn btn-sm rounded-0 px-3 text-uppercase fw-bold"
               style="{{ !request('categoria') ? 'background:#111; color:#f0a500; border:1px solid #333;' : 'background:transparent; color:#333; border:1px solid #ccc;' }}">
               <i class="bi bi-grid me-1"></i> Ver Todo
            </a>
            @foreach($categorias as $cat)
                <a href="{{ route('dashboard', ['categoria' => $cat->categoria]) }}"
                   class="btn btn-sm rounded-0 px-3 text-uppercase fw-bold"
                   style="{{ request('categoria') == $cat->categoria ? 'background:#111; color:#f0a500; border:1px solid #333;' : 'background:transparent; color:#333; border:1px solid #ccc;' }}">
                    {{ $cat->categoria }}
                    <span class="ms-1" style="opacity:.5;">{{ $cat->total }}</span>
                </a>
            @endforeach
        </div>
    </div>

    {{-- ====================== LOCALES ====================== --}}
    <div class="mb-5">
        <div class="row align-items-center mb-4">
            <div class="col-8">
                <h4 class="h5 text-uppercase fw-bold m-0" style="border-left:4px solid #f0a500; padding-left:12px;">
                    @if(request('categoria'))
                        <i class="bi bi-tag me-1"></i> {{ request('categoria') }}
                    @elseif(request('q'))
                        <i class="bi bi-search me-1"></i> "{{ request('q') }}"
                    @else
                        <i class="bi bi-clock-history me-1"></i> Registros Recientes
                    @endif
                </h4>
            </div>
            <div class="col-4 text-end">
                @auth
                <a href="{{ route('locales.pdf') }}" target="_blank"
                   class="btn btn-sm rounded-0 fw-bold text-uppercase me-1"
                   style="background:transparent; border:1px solid #ccc; color:#333; font-size:.7rem;">
                    <i class="bi bi-file-earmark-pdf"></i> PDF
                </a>
                <a href="{{ route('locales.excel') }}"
                   class="btn btn-sm rounded-0 fw-bold text-uppercase"
                   style="background:transparent; border:1px solid #ccc; color:#333; font-size:.7rem;">
                    <i class="bi bi-file-earmark-excel"></i> Excel
                </a>
                @endauth
            </div>
        </div>

        @if($locales->isEmpty())
            <div class="p-5 border text-center rounded-0" style="background:#f9f9f9;">
                <i class="bi bi-inbox" style="font-size:2.5rem; opacity:.3;"></i>
                <p class="mb-0 fw-bold mt-2 text-uppercase small">No se encontraron registros.</p>
                <a href="{{ route('dashboard') }}" class="btn btn-sm rounded-0 mt-3 text-uppercase fw-bold text-dark" style="background:#f0a500;">
                    Limpiar Filtros
                </a>
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach($locales as $local)
                <div class="col">
                    <div class="card h-100 rounded-0 shadow-none position-relative" style="border:1px solid #e0e0e0;">

                        @auth
                        <div class="position-absolute top-0 end-0 p-2 d-flex gap-1" style="z-index:10;">
                            <a href="{{ route('locales.edit', $local->id) }}"
                               class="btn btn-sm rounded-0 py-1 px-2 fw-bold text-uppercase"
                               style="background:#111; color:#f0a500; border:none; font-size:.65rem;">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <form action="{{ route('locales.destroy', $local->id) }}" method="POST"
                                  onsubmit="return confirm('¿Confirmar eliminación?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm rounded-0 py-1 px-2"
                                        style="background:#333; color:#ccc; border:none; font-size:.65rem;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                        @endauth

                        {{-- Imagen placeholder con icono de categoría --}}
                        <div class="d-flex align-items-center justify-content-center border-bottom"
                             style="height:100px; background:#111;">
                            @php
                                $iconos = [
                                    'Ropa'       => 'bi-handbag',
                                    'Calzado'    => 'bi-bag',
                                    'Comida'     => 'bi-cup-hot',
                                    'Accesorios' => 'bi-gem',
                                    'Electrónica'=> 'bi-cpu',
                                ];
                                $icono = $iconos[$local->categoria] ?? 'bi-shop';
                            @endphp
                            <i class="bi {{ $icono }}" style="font-size:2.2rem; color:#f0a500; opacity:.7;"></i>
                        </div>

                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold text-uppercase px-2 py-1"
                                      style="background:#111; color:#f0a500; font-size:.6rem; letter-spacing:1px;">
                                    {{ $local->categoria }}
                                </span>
                                <small style="font-size:.65rem; color:#aaa;">
                                    <i class="bi bi-eye me-1"></i>{{ $local->visitas }}
                                </small>
                            </div>

                            <h5 class="fw-bold text-uppercase mb-1" style="font-size:.9rem;">{{ $local->nombre }}</h5>

                            <p class="mb-3 pb-2 border-bottom" style="font-size:.72rem; color:#888; text-transform:uppercase;">
                                <i class="bi bi-person me-1"></i>
                                {{ $local->vendedor->nombre ?? 'Sin asignar' }}
                            </p>

                            <p class="text-truncate mb-3" style="font-size:.78rem; color:#666;">
                                {{ $local->descripcion ?: 'Sin descripción.' }}
                            </p>

                            <div class="pt-2 border-top">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="d-block fw-bold" style="font-size:.65rem; color:#aaa; letter-spacing:1px;">HORARIO</small>
                                        <small class="fw-bold text-dark">
                                            {{ \Carbon\Carbon::parse($local->hora_apertura)->format('H:i') }} —
                                            {{ \Carbon\Carbon::parse($local->hora_cierre)->format('H:i') }}
                                        </small>
                                    </div>
                                    @php
                                        $now2    = \Carbon\Carbon::now();
                                        $abre2   = \Carbon\Carbon::parse($local->hora_apertura);
                                        $cierra2 = \Carbon\Carbon::parse($local->hora_cierre);
                                        $estaAbierto = $now2->between($abre2, $cierra2);
                                    @endphp
                                    <span class="fw-bold text-uppercase px-2 py-1"
                                          style="font-size:.6rem; letter-spacing:1px;
                                                 {{ $estaAbierto ? 'background:#f0a500; color:#000;' : 'background:#1a1a1a; color:#888;' }}">
                                        <i class="bi bi-circle-fill me-1" style="font-size:.4rem;"></i>
                                        {{ $estaAbierto ? 'ABIERTO' : 'CERRADO' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer p-0" style="background:#f9f9f9; border-top:1px solid #e0e0e0;">
                            <div class="d-flex justify-content-between align-items-center px-3 py-2">
                                <small class="fw-bold text-uppercase" style="font-size:.65rem;">
                                    <i class="bi bi-geo-alt me-1" style="color:#f0a500;"></i>{{ $local->ubicacion }}
                                </small>
                                <button type="button"
                                        class="btn btn-sm rounded-0 fw-bold text-uppercase py-0 px-2"
                                        style="background:#111; color:#f0a500; font-size:.65rem; border:none;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalLocal{{ $local->id }}">
                                    Ver más <i class="bi bi-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- MODAL --}}
                    <div class="modal fade" id="modalLocal{{ $local->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-0 border-0">
                                <div class="modal-header text-white rounded-0" style="background:#111; border-bottom:2px solid #f0a500;">
                                    <div>
                                        <h5 class="modal-title fw-bold text-uppercase fs-6">{{ $local->nombre }}</h5>
                                        <small style="color:#f0a500; font-size:.65rem; letter-spacing:1px;">{{ $local->categoria }}</small>
                                    </div>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body p-4">
                                    @if($local->descripcion)
                                    <div class="mb-3">
                                        <small class="text-uppercase fw-bold d-block mb-1" style="font-size:.65rem; letter-spacing:1px; color:#aaa;">Descripción</small>
                                        <p class="mb-0 ps-3" style="border-left:3px solid #f0a500;">{{ $local->descripcion }}</p>
                                    </div>
                                    @endif

                                    <div class="row g-3 mb-3">
                                        <div class="col-6">
                                            <small class="text-uppercase fw-bold d-block mb-1" style="font-size:.65rem; color:#aaa;">Ubicación</small>
                                            <span class="fw-bold"><i class="bi bi-geo-alt me-1" style="color:#f0a500;"></i>{{ $local->ubicacion }}</span>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-uppercase fw-bold d-block mb-1" style="font-size:.65rem; color:#aaa;">Días Laborales</small>
                                            <span class="fw-bold" style="font-size:.85rem;">{{ $local->dias_laborales }}</span>
                                        </div>
                                    </div>

                                    <div class="p-3 mb-3" style="background:#f9f9f9; border-left:3px solid #f0a500;">
                                        <small class="text-uppercase fw-bold d-block mb-2" style="font-size:.65rem; color:#aaa;">Vendedor</small>
                                        <div class="fw-bold fs-6">{{ $local->vendedor->nombre ?? 'Sin asignar' }}</div>
                                        @if($local->vendedor)
                                            @if($local->vendedor->telefono)
                                                <small class="d-block mt-1" style="color:#555;">
                                                    <i class="bi bi-telephone me-1" style="color:#f0a500;"></i>{{ $local->vendedor->telefono }}
                                                </small>
                                            @endif
                                            @if($local->vendedor->email)
                                                <small class="d-block mt-1" style="color:#555;">
                                                    <i class="bi bi-envelope me-1" style="color:#f0a500;"></i>{{ $local->vendedor->email }}
                                                </small>
                                            @endif
                                        @endif
                                    </div>

                                    @if($local->latitud && $local->longitud)
                                        <div>
                                            <small class="text-uppercase fw-bold d-block mb-2" style="font-size:.65rem; color:#aaa;">
                                                <i class="bi bi-map me-1" style="color:#f0a500;"></i>Ubicación en el Mapa
                                            </small>
                                            <div class="ratio ratio-16x9" style="border:1px solid #ddd;">
                                                <iframe src="https://maps.google.com/maps?q={{ $local->latitud }},{{ $local->longitud }}&hl=es&z=18&output=embed"
                                                        style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                            </div>
                                            <div class="mt-2 text-end">
                                                <a href="https://www.google.com/maps/search/?api=1&query={{ $local->latitud }},{{ $local->longitud }}"
                                                   target="_blank"
                                                   class="btn btn-sm rounded-0 fw-bold text-uppercase text-dark"
                                                   style="background:#f0a500; font-size:.65rem;">
                                                    <i class="bi bi-map-fill me-1"></i> Abrir en Google Maps
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-center pt-2" style="border-top:1px solid #eee;">
                                            <small class="text-muted fst-italic">
                                                <i class="bi bi-geo me-1"></i>Ubicación GPS no registrada
                                            </small>
                                        </div>
                                    @endif
                                </div>
                                <div class="modal-footer" style="background:#f9f9f9; border-top:1px solid #eee;">
                                    <button type="button"
                                            class="btn btn-sm rounded-0 fw-bold text-uppercase"
                                            style="background:#111; color:#f0a500; border:none;"
                                            data-bs-dismiss="modal">
                                        Cerrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

{{-- CHART.JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
Chart.defaults.font.family = "'Segoe UI', system-ui, sans-serif";
Chart.defaults.font.size   = 11;

@if(!$porCategoria->isEmpty())
(function () {
    var labels = @json($porCategoria->pluck('categoria'));
    var datos  = @json($porCategoria->pluck('total'));
    var palette = ['#f0a500','#1a1a1a','#555','#888','#ccc'];

    new Chart(document.getElementById('graficaCategorias'), {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: datos,
                backgroundColor: palette.slice(0, labels.length),
                borderWidth: 3,
                borderColor: '#fff',
                hoverOffset: 6
            }]
        },
        options: {
            responsive: true,
            cutout: '68%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { padding: 14, usePointStyle: true, pointStyle: 'rectRounded' }
                },
                tooltip: {
                    callbacks: {
                        label: function(ctx) {
                            var total = ctx.dataset.data.reduce((a,b)=>a+b,0);
                            var pct = Math.round(ctx.parsed/total*100);
                            return '  '+ctx.label+': '+ctx.parsed+' ('+pct+'%)';
                        }
                    }
                }
            }
        }
    });
})();
@endif

@if(!$porDias->isEmpty())
(function () {
    var labels = @json($porDias->pluck('dias_laborales'));
    var datos  = @json($porDias->pluck('total'));

    new Chart(document.getElementById('graficaDias'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Negocios',
                data: datos,
                backgroundColor: '#1a1a1a',
                hoverBackgroundColor: '#f0a500',
                borderRadius: 0,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(ctx) { return '  '+ctx.parsed.x+' negocio(s)'; }
                    }
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 },
                    grid: { color: 'rgba(0,0,0,.05)' }
                },
                y: { grid: { display: false } }
            }
        }
    });
})();
@endif
</script>

@endsection
