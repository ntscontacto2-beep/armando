@extends('layouts.app')

@section('content')

<div class="bg-black text-white py-4 border-bottom border-secondary">
    <div class="container d-flex align-items-center justify-content-between">
        <div>
            <h1 class="h3 text-uppercase fw-bold m-0">Vendedores</h1>
            <small class="text-secondary">{{ $vendedores->count() }} registrados</small>
        </div>
        <button class="btn btn-sm rounded-0 fw-bold text-uppercase text-dark"
                style="background:#f0a500;"
                data-bs-toggle="modal" data-bs-target="#modalNuevoVendedor">
            <i class="bi bi-person-plus-fill me-1"></i> Nuevo Vendedor
        </button>
    </div>
</div>

<div class="container my-5">

    @if(session('success'))
        <div class="alert alert-dark rounded-0 border-0 mb-4 bg-dark text-white">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    @if($vendedores->isEmpty())
        <div class="p-5 bg-light border text-center text-muted rounded-0">
            <i class="bi bi-people" style="font-size:3rem; opacity:.3;"></i>
            <p class="mb-0 fw-bold mt-3 text-uppercase">No hay vendedores registrados.</p>
            <button class="btn btn-dark btn-sm rounded-0 mt-3 text-uppercase fw-bold"
                    data-bs-toggle="modal" data-bs-target="#modalNuevoVendedor">
                Registrar el Primero
            </button>
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($vendedores as $vendedor)
            <div class="col">
                <div class="card h-100 rounded-0 border border-secondary border-opacity-25 shadow-none">
                    <div class="bg-secondary bg-opacity-10 border-bottom border-secondary border-opacity-10 d-flex align-items-center justify-content-center"
                         style="height:110px;">
                        @if($vendedor->foto)
                            <img src="{{ asset('storage/' . $vendedor->foto) }}" alt="{{ $vendedor->nombre }}"
                                 style="height:90px; width:90px; object-fit:cover;">
                        @else
                            <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center fw-black"
                                 style="width:68px; height:68px; font-size:1.6rem;">
                                {{ strtoupper(substr($vendedor->nombre, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body p-3">
                        <h5 class="fw-bold text-uppercase fs-6 mb-2">{{ $vendedor->nombre }}</h5>
                        <div class="d-flex flex-column gap-1">
                            @if($vendedor->telefono)
                                <small class="text-secondary">
                                    <i class="bi bi-telephone-fill me-1 text-dark" style="font-size:.7rem;"></i>{{ $vendedor->telefono }}
                                </small>
                            @endif
                            @if($vendedor->email)
                                <small class="text-secondary text-truncate">
                                    <i class="bi bi-envelope-fill me-1 text-dark" style="font-size:.7rem;"></i>{{ $vendedor->email }}
                                </small>
                            @endif
                            @if(!$vendedor->telefono && !$vendedor->email)
                                <small class="text-muted fst-italic">Sin datos de contacto</small>
                            @endif
                        </div>
                        @php $totalLocales = $vendedor->locales->count(); @endphp
                        <div class="mt-3 pt-2 border-top d-flex justify-content-between align-items-center">
                            <span class="badge bg-dark rounded-0 fw-normal" style="font-size:.65rem;">
                                {{ $totalLocales }} {{ $totalLocales === 1 ? 'local' : 'locales' }}
                            </span>
                            <form action="{{ route('vendedores.destroy', $vendedor->id) }}" method="POST"
                                  onsubmit="return confirm('Eliminar a {{ addslashes($vendedor->nombre) }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-0 py-0 px-2">
                                    <i class="bi bi-trash" style="font-size:.75rem;"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

{{-- MODAL: Nuevo Vendedor --}}
<div class="modal fade" id="modalNuevoVendedor" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 border-0">
            <div class="modal-header bg-black text-white rounded-0 border-secondary">
                <h5 class="modal-title fw-bold text-uppercase fs-6">Registrar Vendedor</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('vendedores.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-uppercase fw-bold small text-secondary">Nombre *</label>
                        <input type="text" name="nombre" class="form-control rounded-0 bg-light border-secondary"
                               placeholder="Nombre completo" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-uppercase fw-bold small text-secondary">Teléfono</label>
                            <input type="text" name="telefono" class="form-control rounded-0 bg-light border-secondary"
                                   placeholder="Ej. 2221234567">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-uppercase fw-bold small text-secondary">Email</label>
                            <input type="email" name="email" class="form-control rounded-0 bg-light border-secondary"
                                   placeholder="correo@ejemplo.com">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-uppercase fw-bold small text-secondary">Foto (opcional)</label>
                        <input type="file" name="foto" class="form-control rounded-0 bg-light border-secondary"
                               accept="image/*">
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline-secondary rounded-0 text-uppercase fw-bold"
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark rounded-0 px-4 text-uppercase fw-bold">
                            <i class="bi bi-person-check me-1"></i> Registrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
