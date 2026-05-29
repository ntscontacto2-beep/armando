@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="bg-black text-white" style="border-bottom:3px solid #f0a500; padding:2rem 0;">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <small class="fw-bold text-uppercase d-block mb-1" style="font-size:.6rem; letter-spacing:4px; color:#f0a500;">
                    <i class="bi bi-shop me-1"></i> Nuevo Registro
                </small>
                <h1 class="fw-black text-uppercase m-0" style="font-size:clamp(1.4rem,4vw,2.2rem); letter-spacing:-1px;">
                    Agregar Negocio
                </h1>
            </div>
            <a href="{{ route('dashboard') }}"
               class="btn btn-sm rounded-0 fw-bold text-uppercase"
               style="border:1px solid #333; color:#888; font-size:.68rem; letter-spacing:1px;">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">

        {{-- FORMULARIO --}}
        <div class="col-lg-8">
            <form action="{{ route('locales.store') }}" method="POST" id="form-negocio">
                @csrf

                {{-- BLOQUE 1: IDENTIDAD --}}
                <div class="mb-4" style="border:1px solid #e8e8e8; border-top:3px solid #f0a500;">
                    <div class="px-4 pt-3 pb-1" style="background:#fafafa; border-bottom:1px solid #e8e8e8;">
                        <small class="fw-bold text-uppercase" style="font-size:.6rem; letter-spacing:3px; color:#f0a500;">
                            <i class="bi bi-1-circle-fill me-1"></i> Información Básica
                        </small>
                    </div>
                    <div class="p-4">

                        {{-- NOMBRE --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold text-uppercase mb-1" style="font-size:.68rem; letter-spacing:1px; color:#333;">
                                Nombre del Negocio <span style="color:#f0a500;">*</span>
                            </label>
                            <input type="text" name="nombre"
                                   class="form-control rounded-0 @error('nombre') is-invalid @enderror"
                                   style="border-color:#ccc; font-size:.9rem; padding:.6rem .9rem;"
                                   placeholder="Ej. Ropa Deportiva El Primo"
                                   value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- CATEGORÍA + VENDEDOR --}}
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-uppercase mb-1" style="font-size:.68rem; letter-spacing:1px; color:#333;">
                                    Categoría <span style="color:#f0a500;">*</span>
                                </label>
                                <select name="categoria" class="form-select rounded-0" style="border-color:#ccc; font-size:.9rem;">
                                    @foreach(['Ropa','Accesorios','Comida','Calzado','Electrónica'] as $cat)
                                        <option value="{{ $cat }}" {{ old('categoria') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-uppercase mb-1" style="font-size:.68rem; letter-spacing:1px; color:#333;">
                                    Vendedor Responsable <span style="color:#f0a500;">*</span>
                                </label>
                                <select name="vendedor_id" class="form-select rounded-0 @error('vendedor_id') is-invalid @enderror"
                                        style="border-color:#ccc; font-size:.9rem;" required>
                                    <option value="">— Seleccionar —</option>
                                    @foreach($vendedores as $vendedor)
                                        <option value="{{ $vendedor->id }}" {{ old('vendedor_id') == $vendedor->id ? 'selected' : '' }}>
                                            {{ $vendedor->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('vendedor_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                {{-- BLOQUE 2: UBICACIÓN --}}
                <div class="mb-4" style="border:1px solid #e8e8e8; border-top:3px solid #f0a500;">
                    <div class="px-4 pt-3 pb-1" style="background:#fafafa; border-bottom:1px solid #e8e8e8;">
                        <small class="fw-bold text-uppercase" style="font-size:.6rem; letter-spacing:3px; color:#f0a500;">
                            <i class="bi bi-2-circle-fill me-1"></i> Ubicación dentro del Tianguis
                        </small>
                    </div>
                    <div class="p-4">

                        <div class="mb-4">
                            <label class="form-label fw-bold text-uppercase mb-1" style="font-size:.68rem; letter-spacing:1px; color:#333;">
                                Pasillo / Número de Local <span style="color:#f0a500;">*</span>
                            </label>
                            <input type="text" name="ubicacion"
                                   class="form-control rounded-0 @error('ubicacion') is-invalid @enderror"
                                   style="border-color:#ccc; font-size:.9rem; padding:.6rem .9rem;"
                                   placeholder="Ej. Pasillo B, Local 14"
                                   value="{{ old('ubicacion') }}" required>
                            @error('ubicacion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- MAPA PICKER --}}
                        <label class="form-label fw-bold text-uppercase mb-2 d-flex align-items-center gap-2" style="font-size:.68rem; letter-spacing:1px; color:#333;">
                            <i class="bi bi-pin-map-fill" style="color:#f0a500; font-size:.85rem;"></i>
                            Coordenadas GPS
                            <span class="fw-normal text-muted" style="font-size:.65rem; letter-spacing:0; text-transform:none;">— Haz clic en el mapa para colocar el marcador</span>
                        </label>

                        <div id="mapa-create"
                             style="height:300px; border:1px solid #ddd; border-top:3px solid #f0a500; cursor:crosshair; background:#f0f0f0;"
                             class="mb-3 position-relative">
                        </div>

                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-uppercase mb-1" style="font-size:.63rem; letter-spacing:1px; color:#888;">Latitud</label>
                                <div class="input-group">
                                    <span class="input-group-text rounded-0 border-end-0" style="background:#111; color:#f0a500; border-color:#ccc; font-size:.8rem;">
                                        <i class="bi bi-geo"></i>
                                    </span>
                                    <input type="text" id="latitud" name="latitud"
                                           class="form-control rounded-0 border-start-0"
                                           style="border-color:#ccc; font-size:.85rem; font-family:monospace;"
                                           placeholder="19.283456" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-uppercase mb-1" style="font-size:.63rem; letter-spacing:1px; color:#888;">Longitud</label>
                                <div class="input-group">
                                    <span class="input-group-text rounded-0 border-end-0" style="background:#111; color:#f0a500; border-color:#ccc; font-size:.8rem;">
                                        <i class="bi bi-geo"></i>
                                    </span>
                                    <input type="text" id="longitud" name="longitud"
                                           class="form-control rounded-0 border-start-0"
                                           style="border-color:#ccc; font-size:.85rem; font-family:monospace;"
                                           placeholder="-98.432112" readonly>
                                </div>
                            </div>
                        </div>

                        <div id="coords-hint" class="mt-2" style="display:none;">
                            <small style="color:#f0a500; font-size:.68rem;">
                                <i class="bi bi-check-circle-fill me-1"></i>Coordenadas capturadas. Puedes mover el marcador haciendo otro clic.
                            </small>
                        </div>

                    </div>
                </div>

                {{-- BLOQUE 3: HORARIO --}}
                <div class="mb-4" style="border:1px solid #e8e8e8; border-top:3px solid #f0a500;">
                    <div class="px-4 pt-3 pb-1" style="background:#fafafa; border-bottom:1px solid #e8e8e8;">
                        <small class="fw-bold text-uppercase" style="font-size:.6rem; letter-spacing:3px; color:#f0a500;">
                            <i class="bi bi-3-circle-fill me-1"></i> Horario de Atención
                        </small>
                    </div>
                    <div class="p-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-bold text-uppercase mb-1" style="font-size:.68rem; letter-spacing:1px; color:#333;">
                                    Días Laborales <span style="color:#f0a500;">*</span>
                                </label>
                                <select name="dias_laborales" class="form-select rounded-0" style="border-color:#ccc; font-size:.9rem;" required>
                                    @foreach(['Lunes a Domingo','Solo Martes (Día de Tianguis)','Fines de Semana','Lunes a Viernes'] as $dia)
                                        <option value="{{ $dia }}" {{ old('dias_laborales') == $dia ? 'selected' : '' }}>{{ $dia }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-uppercase mb-1" style="font-size:.68rem; letter-spacing:1px; color:#333;">
                                    Hora Apertura <span style="color:#f0a500;">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text rounded-0" style="background:#111; color:#f0a500; border-color:#ccc; font-size:.8rem;">
                                        <i class="bi bi-door-open"></i>
                                    </span>
                                    <input type="time" name="hora_apertura"
                                           class="form-control rounded-0"
                                           style="border-color:#ccc; font-size:.9rem;"
                                           value="{{ old('hora_apertura') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-uppercase mb-1" style="font-size:.68rem; letter-spacing:1px; color:#333;">
                                    Hora Cierre <span style="color:#f0a500;">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text rounded-0" style="background:#111; color:#f0a500; border-color:#ccc; font-size:.8rem;">
                                        <i class="bi bi-door-closed"></i>
                                    </span>
                                    <input type="time" name="hora_cierre"
                                           class="form-control rounded-0"
                                           style="border-color:#ccc; font-size:.9rem;"
                                           value="{{ old('hora_cierre') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BLOQUE 4: DESCRIPCIÓN --}}
                <div class="mb-4" style="border:1px solid #e8e8e8; border-top:3px solid #f0a500;">
                    <div class="px-4 pt-3 pb-1" style="background:#fafafa; border-bottom:1px solid #e8e8e8;">
                        <small class="fw-bold text-uppercase" style="font-size:.6rem; letter-spacing:3px; color:#f0a500;">
                            <i class="bi bi-4-circle-fill me-1"></i> Descripción
                        </small>
                    </div>
                    <div class="p-4">
                        <label class="form-label fw-bold text-uppercase mb-1" style="font-size:.68rem; letter-spacing:1px; color:#333;">
                            Descripción Breve <span class="fw-normal text-muted" style="text-transform:none; letter-spacing:0;">(opcional)</span>
                        </label>
                        <textarea name="descripcion"
                                  class="form-control rounded-0"
                                  style="border-color:#ccc; font-size:.9rem; resize:vertical;"
                                  rows="3"
                                  placeholder="Describe brevemente los productos o servicios que ofreces...">{{ old('descripcion') }}</textarea>
                    </div>
                </div>

                {{-- BOTONES --}}
                <div class="d-flex justify-content-between align-items-center pt-2">
                    <a href="{{ route('dashboard') }}"
                       class="text-decoration-none fw-bold text-uppercase"
                       style="font-size:.72rem; letter-spacing:1px; color:#aaa;">
                        <i class="bi bi-x-lg me-1"></i> Cancelar
                    </a>
                    <button type="submit"
                            class="btn fw-black text-uppercase rounded-0 px-5"
                            style="background:#f0a500; color:#000; letter-spacing:1px; font-size:.82rem;">
                        <i class="bi bi-shop-window me-2"></i> Registrar Negocio
                    </button>
                </div>

            </form>
        </div>

        {{-- SIDEBAR --}}
        <div class="col-lg-4 d-none d-lg-block">
            <div style="position:sticky; top:1.5rem;">

                {{-- Guía --}}
                <div style="border:1px solid #e8e8e8; border-top:3px solid #f0a500;" class="mb-3">
                    <div class="px-4 pt-3 pb-1" style="background:#fafafa; border-bottom:1px solid #e8e8e8;">
                        <small class="fw-bold text-uppercase" style="font-size:.6rem; letter-spacing:3px; color:#f0a500;">
                            <i class="bi bi-info-circle me-1"></i> Guía Rápida
                        </small>
                    </div>
                    <div class="p-4">
                        <ul class="list-unstyled m-0" style="font-size:.78rem; color:#555; line-height:1.9;">
                            <li class="d-flex gap-2">
                                <i class="bi bi-check2" style="color:#f0a500; flex-shrink:0; margin-top:3px;"></i>
                                <span>Elige la categoría que mejor describa tu negocio</span>
                            </li>
                            <li class="d-flex gap-2">
                                <i class="bi bi-check2" style="color:#f0a500; flex-shrink:0; margin-top:3px;"></i>
                                <span>El vendedor responsable debe estar registrado previamente</span>
                            </li>
                            <li class="d-flex gap-2">
                                <i class="bi bi-check2" style="color:#f0a500; flex-shrink:0; margin-top:3px;"></i>
                                <span>Haz clic en el mapa para fijar tu ubicación exacta</span>
                            </li>
                            <li class="d-flex gap-2">
                                <i class="bi bi-check2" style="color:#f0a500; flex-shrink:0; margin-top:3px;"></i>
                                <span>Las coordenadas GPS son opcionales pero ayudan a los clientes a encontrarte</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Categorías disponibles --}}
                <div style="border:1px solid #e8e8e8;">
                    <div class="px-4 pt-3 pb-1" style="background:#fafafa; border-bottom:1px solid #e8e8e8;">
                        <small class="fw-bold text-uppercase" style="font-size:.6rem; letter-spacing:3px; color:#555;">
                            Categorías Disponibles
                        </small>
                    </div>
                    <div class="p-4">
                        @php
                            $iconMap = ['Ropa'=>'bi-handbag','Accesorios'=>'bi-gem','Comida'=>'bi-cup-hot','Calzado'=>'bi-bag','Electrónica'=>'bi-cpu'];
                        @endphp
                        <div class="d-flex flex-column gap-2">
                            @foreach($iconMap as $nombre => $icono)
                            <div class="d-flex align-items-center gap-3" style="padding:.4rem .6rem; border-left:2px solid transparent;"
                                 onmouseover="this.style.borderLeftColor='#f0a500'"
                                 onmouseout="this.style.borderLeftColor='transparent'">
                                <i class="bi {{ $icono }}" style="font-size:1rem; color:#111; width:18px; text-align:center;"></i>
                                <span style="font-size:.78rem; color:#444; font-weight:600; text-transform:uppercase; letter-spacing:.5px;">{{ $nombre }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

{{-- Google Maps API --}}
@if($googleMapsKey && $googleMapsKey !== 'TU_CLAVE_GOOGLE_MAPS_AQUI')
<script>
function initMapCreate() {
    var centro = { lat: 19.2895, lng: -98.4395 };

    var estiloMapa = [
        { featureType:'poi', stylers:[{visibility:'off'}] },
        { elementType:'geometry', stylers:[{color:'#f5f5f5'}] },
        { elementType:'labels.icon', stylers:[{visibility:'off'}] },
        { featureType:'road', elementType:'geometry', stylers:[{color:'#ffffff'}] },
        { featureType:'road.arterial', elementType:'labels.text.fill', stylers:[{color:'#757575'}] },
        { featureType:'water', elementType:'geometry', stylers:[{color:'#c9c9c9'}] }
    ];

    var map = new google.maps.Map(document.getElementById('mapa-create'), {
        zoom: 17,
        center: centro,
        styles: estiloMapa,
        mapTypeControl: true,
        streetViewControl: false,
        fullscreenControl: true
    });

    var iconMarker = {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        fillColor: '#f0a500',
        fillOpacity: 1,
        strokeColor: '#000',
        strokeWeight: 2
    };

    var marker = null;

    map.addListener('click', function (event) {
        var lat = event.latLng.lat();
        var lng = event.latLng.lng();

        document.getElementById('latitud').value  = lat.toFixed(7);
        document.getElementById('longitud').value = lng.toFixed(7);
        document.getElementById('coords-hint').style.display = 'block';

        if (marker) {
            marker.setPosition(event.latLng);
        } else {
            marker = new google.maps.Marker({
                position: event.latLng,
                map: map,
                title: 'Ubicación del local',
                icon: iconMarker,
                animation: google.maps.Animation.DROP
            });
        }
    });
}
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{ $googleMapsKey }}&callback=initMapCreate&language=es&region=MX">
</script>
@else
<script>
document.getElementById('mapa-create').innerHTML =
    '<div style="display:flex;align-items:center;justify-content:center;height:100%;flex-direction:column;gap:.6rem;color:#aaa;">' +
    '<i class="bi bi-map" style="font-size:2.5rem; color:#ddd;"></i>' +
    '<p style="font-size:.75rem;margin:0;color:#bbb;">Configura <code>GOOGLE_MAPS_API_KEY</code> en <code>.env</code></p>' +
    '</div>';
document.getElementById('latitud').removeAttribute('readonly');
document.getElementById('longitud').removeAttribute('readonly');
</script>
@endif

@endsection
