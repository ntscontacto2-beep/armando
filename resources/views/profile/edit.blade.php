@extends('layouts.app')

@section('content')

<div class="bg-black text-white py-4 border-bottom border-secondary">
    <div class="container">
        <h1 class="h3 text-uppercase fw-bold m-0">Mi Perfil</h1>
        <small class="text-secondary">{{ Auth::user()->email }}</small>
    </div>
</div>

<div class="container my-5">
    <div class="row g-4 justify-content-center">
        <div class="col-lg-8">

            {{-- MENSAJES --}}
            @if(session('status') === 'profile-updated')
                <div class="alert alert-dark rounded-0 border-0 mb-4 bg-dark text-white">
                    <i class="bi bi-check-circle me-2"></i> Perfil actualizado correctamente.
                </div>
            @endif
            @if(session('status') === 'password-updated')
                <div class="alert alert-dark rounded-0 border-0 mb-4 bg-dark text-white">
                    <i class="bi bi-check-circle me-2"></i> Contraseña actualizada correctamente.
                </div>
            @endif

            {{-- TARJETA: INFORMACIÓN --}}
            <div class="card rounded-0 border border-secondary shadow-sm mb-4">
                <div class="card-header bg-black text-white border-secondary py-3">
                    <h5 class="fw-bold text-uppercase mb-0 fs-6">
                        <i class="bi bi-person-fill me-2"></i>Información de la Cuenta
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-uppercase fw-bold small text-secondary">Nombre</label>
                                <input type="text" name="name"
                                       value="{{ old('name', $user->name) }}"
                                       class="form-control rounded-0 bg-light border-secondary @error('name') is-invalid @enderror"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-uppercase fw-bold small text-secondary">Correo Electrónico</label>
                                <input type="email" name="email"
                                       value="{{ old('email', $user->email) }}"
                                       class="form-control rounded-0 bg-light border-secondary @error('email') is-invalid @enderror"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-between align-items-center">
                            <small class="text-muted">Cuenta creada: {{ $user->created_at->format('d/m/Y') }}</small>
                            <button type="submit" class="btn btn-dark rounded-0 px-4 text-uppercase fw-bold">
                                <i class="bi bi-save me-1"></i> Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- TARJETA: CONTRASEÑA --}}
            <div class="card rounded-0 border border-secondary shadow-sm mb-4">
                <div class="card-header bg-black text-white border-secondary py-3">
                    <h5 class="fw-bold text-uppercase mb-0 fs-6">
                        <i class="bi bi-shield-lock-fill me-2"></i>Cambiar Contraseña
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label text-uppercase fw-bold small text-secondary">Contraseña Actual</label>
                                <input type="password" name="current_password"
                                       class="form-control rounded-0 bg-light border-secondary @error('current_password', 'updatePassword') is-invalid @enderror"
                                       autocomplete="current-password">
                                @error('current_password', 'updatePassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-uppercase fw-bold small text-secondary">Nueva Contraseña</label>
                                <input type="password" name="password"
                                       class="form-control rounded-0 bg-light border-secondary @error('password', 'updatePassword') is-invalid @enderror"
                                       autocomplete="new-password">
                                @error('password', 'updatePassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-uppercase fw-bold small text-secondary">Confirmar Contraseña</label>
                                <input type="password" name="password_confirmation"
                                       class="form-control rounded-0 bg-light border-secondary"
                                       autocomplete="new-password">
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-dark rounded-0 px-4 text-uppercase fw-bold">
                                <i class="bi bi-key me-1"></i> Actualizar Contraseña
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- TARJETA: ELIMINAR CUENTA --}}
            <div class="card rounded-0 border border-danger border-opacity-25 shadow-sm">
                <div class="card-header bg-danger bg-opacity-10 border-danger border-opacity-25 py-3">
                    <h5 class="fw-bold text-uppercase mb-0 fs-6 text-danger">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>Zona de Peligro
                    </h5>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted small mb-3">
                        Una vez que elimines tu cuenta, todos los datos serán borrados permanentemente. Esta acción no se puede deshacer.
                    </p>
                    <button type="button" class="btn btn-outline-danger rounded-0 text-uppercase fw-bold"
                            data-bs-toggle="modal" data-bs-target="#modalEliminarCuenta">
                        <i class="bi bi-trash me-1"></i> Eliminar mi Cuenta
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- MODAL: Confirmar Eliminación --}}
<div class="modal fade" id="modalEliminarCuenta" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 border-0">
            <div class="modal-header bg-danger text-white rounded-0">
                <h5 class="modal-title fw-bold text-uppercase">¿Eliminar cuenta?</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-muted mb-3">
                    Esta acción es <strong>irreversible</strong>. Todos tus datos serán eliminados permanentemente.
                    Escribe tu contraseña para confirmar.
                </p>
                <form method="POST" action="{{ route('profile.destroy') }}" id="formEliminarCuenta">
                    @csrf
                    @method('DELETE')
                    <div class="mb-3">
                        <label class="form-label text-uppercase fw-bold small text-secondary">Contraseña</label>
                        <input type="password" name="password"
                               class="form-control rounded-0 border-secondary @error('password', 'userDeletion') is-invalid @enderror"
                               placeholder="Ingresa tu contraseña" required>
                        @error('password', 'userDeletion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline-secondary rounded-0 text-uppercase fw-bold" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-danger rounded-0 text-uppercase fw-bold">
                            <i class="bi bi-trash me-1"></i> Sí, Eliminar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if($errors->userDeletion->isNotEmpty())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new bootstrap.Modal(document.getElementById('modalEliminarCuenta')).show();
    });
</script>
@endif

@endsection
