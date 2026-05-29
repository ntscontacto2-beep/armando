@extends('layouts.app')

@section('content')

<div class="bg-black text-white py-4 border-bottom border-secondary">
    <div class="container">
        <h1 class="h3 text-uppercase fw-bold m-0">Editar Negocio</h1>
        <small class="text-secondary">{{ $local->nombre }}</small>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card rounded-0 border border-secondary shadow-sm">
                <div class="card-body p-4">

                    <form action="{{ route('locales.update', $local->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- NOMBRE --}}
                        <div class="mb-3">
                            <label class="form-label text-uppercase fw-bold small text-secondary">Nombre del Local</label>
                            <input type="text" name="nombre" value="{{ $local->nombre }}"
                                   class="form-control rounded-0 bg-light border-secondary" required>
                        </div>

                        <div class="row g-3 mb-3">
                            {{-- CATEGORÍA --}}
                            <div class="col-md-6">
                                <label class="form-label text-uppercase fw-bold small text-secondary">Categoría</label>
                                <select name="categoria" class="form-select rounded-0 bg-light border-secondary">
                                    @foreach(['Ropa','Accesorios','Comida','Calzado','Electrónica'] as $cat)
                                        <option value="{{ $cat }}" {{ $local->categoria == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- VENDEDOR --}}
                            <div class="col-md-6">
                                <label class="form-label text-uppercase fw-bold small text-secondary">Vendedor Responsable</label>
                                <select name="vendedor_id" class="form-select rounded-0 bg-light border-secondary" required>
                                    <option value="">-- Seleccionar --</option>
                                    @foreach($vendedores as $vendedor)
                                        <option value="{{ $vendedor->id }}" {{ $local->vendedor_id == $vendedor->id ? 'selected' : '' }}>
                                            {{ $vendedor->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- UBICACIÓN --}}
                        <div class="mb-3">
                            <label class="form-label text-uppercase fw-bold small text-secondary">Ubicación (Pasillo/Número)</label>
                            <input type="text" name="ubicacion" value="{{ $local->ubicacion }}"
                                   class="form-control rounded-0 bg-light border-secondary" required>
                        </div>

                        {{-- HORARIO --}}
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label text-uppercase fw-bold small text-secondary">Días Laborales</label>
                                <select name="dias_laborales" class="form-select rounded-0 bg-light border-secondary" required>
                                    @foreach(['Lunes a Domingo','Solo Martes (Día de Tianguis)','Fines de Semana','Lunes a Viernes'] as $dia)
                                        <option value="{{ $dia }}" {{ $local->dias_laborales == $dia ? 'selected' : '' }}>{{ $dia }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-uppercase fw-bold small text-secondary">Hora Apertura</label>
                                <input type="time" name="hora_apertura"
                                       value="{{ \Carbon\Carbon::parse($local->hora_apertura)->format('H:i') }}"
                                       class="form-control rounded-0 bg-light border-secondary" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-uppercase fw-bold small text-secondary">Hora Cierre</label>
                                <input type="time" name="hora_cierre"
                                       value="{{ \Carbon\Carbon::parse($local->hora_cierre)->format('H:i') }}"
                                       class="form-control rounded-0 bg-light border-secondary" required>
                            </div>
                        </div>

                        {{-- DESCRIPCIÓN --}}
                        <div class="mb-4">
                            <label class="form-label text-uppercase fw-bold small text-secondary">Descripción Breve</label>
                            <textarea name="descripcion" class="form-control rounded-0 bg-light border-secondary" rows="3">{{ $local->descripcion }}</textarea>
                        </div>

                        {{-- COORDENADAS --}}
                        <div class="mb-4">
                            <label class="form-label text-uppercase fw-bold small text-secondary">
                                Coordenadas GPS <span class="text-muted fw-normal">(opcional)</span>
                            </label>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <input type="text" name="latitud" value="{{ $local->latitud }}"
                                           class="form-control rounded-0 bg-light border-secondary"
                                           placeholder="Latitud — Ej. 19.283456">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="longitud" value="{{ $local->longitud }}"
                                           class="form-control rounded-0 bg-light border-secondary"
                                           placeholder="Longitud — Ej. -98.432112">
                                </div>
                            </div>
                        </div>

                        {{-- BOTONES --}}
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                            <a href="{{ route('dashboard') }}" class="text-decoration-none text-uppercase text-secondary fw-bold small">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-dark rounded-0 px-4 text-uppercase fw-bold">
                                <i class="bi bi-save me-1"></i> Guardar Cambios
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
