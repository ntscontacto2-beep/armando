@extends('layouts.app')

@section('content')

{{-- HERO --}}
<div class="bg-black text-white" style="min-height:220px; display:flex; align-items:center; border-bottom:3px solid #f0a500;">
    <div class="container py-5">
        <small class="fw-bold text-uppercase d-block mb-2" style="letter-spacing:4px; color:#f0a500; font-size:.65rem;">
            San Martín Texmelucan, Puebla
        </small>
        <h1 class="fw-black text-uppercase mb-1" style="font-size:clamp(2rem,5vw,3.5rem); letter-spacing:-1px;">
            Accesos y Rutas
        </h1>
        <p class="mb-0" style="color:#666; font-size:.85rem; letter-spacing:2px; text-transform:uppercase;">
            Cómo llegar y moverte por el tianguis
        </p>
    </div>
</div>

<div class="container my-5">

    {{-- ============================================================ --}}
    {{-- SECCIÓN 1: LLEGAR AL TIANGUIS                               --}}
    {{-- ============================================================ --}}
    <div class="mb-5">
        <small class="fw-bold text-uppercase d-block mb-3" style="font-size:.62rem; letter-spacing:3px; color:#f0a500;">
            <i class="bi bi-signpost-split me-1"></i> Opciones de Transporte
        </small>

        <div class="row g-3">
            {{-- TRANSPORTE PÚBLICO --}}
            <div class="col-md-4">
                <div class="h-100 p-4 position-relative" style="border:1px solid #e0e0e0; border-top:3px solid #f0a500;">
                    <i class="bi bi-bus-front-fill d-block mb-3" style="font-size:1.8rem; color:#111;"></i>
                    <h6 class="fw-bold text-uppercase mb-2" style="font-size:.78rem; letter-spacing:1px;">Transporte Público</h6>
                    <p class="text-muted mb-3" style="font-size:.82rem; line-height:1.6;">
                        Rutas directas desde <strong>CAPU Puebla</strong> con AU y Estrella Roja.
                        Parada frente al Carril de San Miguel.
                    </p>
                    <div style="background:#f9f9f9; border-left:3px solid #f0a500; padding:.6rem .8rem;">
                        <small style="font-size:.7rem; color:#555;">
                            <i class="bi bi-clock me-1"></i>Salidas cada 20 min aprox.
                        </small>
                    </div>
                </div>
            </div>

            {{-- AUTO PARTICULAR --}}
            <div class="col-md-4">
                <div class="h-100 p-4 position-relative" style="border:1px solid #e0e0e0; border-top:3px solid #f0a500;">
                    <i class="bi bi-car-front-fill d-block mb-3" style="font-size:1.8rem; color:#111;"></i>
                    <h6 class="fw-bold text-uppercase mb-2" style="font-size:.78rem; letter-spacing:1px;">Auto Particular</h6>
                    <p class="text-muted mb-3" style="font-size:.82rem; line-height:1.6;">
                        Salida <strong>"San Martín"</strong> de la Autopista México-Puebla.
                        Estacionamiento disponible en Zona B.
                    </p>
                    <div style="background:#f9f9f9; border-left:3px solid #f0a500; padding:.6rem .8rem;">
                        <small style="font-size:.7rem; color:#555;">
                            <i class="bi bi-p-circle me-1"></i>Estacionamiento gratuito
                        </small>
                    </div>
                </div>
            </div>

            {{-- MAPA INTERNO --}}
            <div class="col-md-4">
                <div class="h-100 p-4 position-relative" style="border:1px solid #e0e0e0; border-top:3px solid #f0a500;">
                    <i class="bi bi-map-fill d-block mb-3" style="font-size:1.8rem; color:#111;"></i>
                    <h6 class="fw-bold text-uppercase mb-2" style="font-size:.78rem; letter-spacing:1px;">Zonas del Tianguis</h6>
                    <div class="d-flex flex-column gap-2" style="font-size:.82rem;">
                        <div class="d-flex align-items-center gap-2">
                            <span style="width:10px;height:10px;background:#f0a500;display:inline-block;flex-shrink:0;"></span>
                            <span class="text-muted">Zona <strong class="text-dark">A</strong> — Ropa y Textiles</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span style="width:10px;height:10px;background:#333;display:inline-block;flex-shrink:0;"></span>
                            <span class="text-muted">Zona <strong class="text-dark">B</strong> — Calzado</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span style="width:10px;height:10px;background:#888;display:inline-block;flex-shrink:0;"></span>
                            <span class="text-muted">Zona <strong class="text-dark">C</strong> — Comida y Varios</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- SECCIÓN 2: PEDIR UBER / DIDI                                --}}
    {{-- ============================================================ --}}
    <div class="mb-5">
        <small class="fw-bold text-uppercase d-block mb-3" style="font-size:.62rem; letter-spacing:3px; color:#f0a500;">
            <i class="bi bi-phone me-1"></i> Pedir un Ride
        </small>
        <div style="background:#111; border-left:4px solid #f0a500; padding:1.5rem 1.75rem;" class="mb-3">
            <div class="row align-items-center g-3">
                <div class="col-md-6">
                    <h5 class="fw-bold text-white text-uppercase mb-1" style="font-size:.9rem; letter-spacing:1px;">
                        <i class="bi bi-geo-alt-fill me-2" style="color:#f0a500;"></i>Destino preconfigurado
                    </h5>
                    <p class="mb-0" style="color:#888; font-size:.8rem;">
                        Tianguis de San Martín Texmelucan, Puebla<br>
                        <span style="color:#666; font-size:.72rem;">19.2895° N, 98.4395° O</span>
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="d-flex gap-3 flex-wrap">

                        {{-- UBER --}}
                        <a href="https://m.uber.com/ul/?action=setPickup&pickup=my_location&dropoff[formatted_address]=Tianguis%20San%20Mart%C3%ADn%20Texmelucan&dropoff[latitude]=19.2895&dropoff[longitude]=-98.4395"
                           target="_blank"
                           class="btn fw-bold text-uppercase rounded-0 d-flex align-items-center gap-2 px-4"
                           style="background:#fff; color:#000; border:none; font-size:.75rem; letter-spacing:1px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm0 4.5a3 3 0 110 6 3 3 0 010-6zm0 15c-3.315 0-6.255-1.695-8.01-4.275C5.43 13.5 8.61 12 12 12s6.57 1.5 8.01 3.225C18.255 18.805 15.315 19.5 12 19.5z"/>
                            </svg>
                            Pedir Uber
                        </a>

                        {{-- DIDI --}}
                        <a href="https://page.didiglobal.com/mx/?from_lat=0&from_lng=0&to_lat=19.2895&to_lng=-98.4395&to_name=Tianguis+San+Mart%C3%ADn+Texmelucan"
                           target="_blank"
                           class="btn fw-bold text-uppercase rounded-0 d-flex align-items-center gap-2 px-4"
                           style="background:#ff6600; color:#fff; border:none; font-size:.75rem; letter-spacing:1px;">
                            <i class="bi bi-car-front-fill"></i>
                            Pedir DiDi
                        </a>

                        {{-- GOOGLE MAPS --}}
                        <a href="https://www.google.com/maps/dir/?api=1&destination=19.2895,-98.4395&destination_place_id=Tianguis+San+Martin+Texmelucan"
                           target="_blank"
                           class="btn fw-bold text-uppercase rounded-0 d-flex align-items-center gap-2 px-4"
                           style="background:#f0a500; color:#000; border:none; font-size:.75rem; letter-spacing:1px;">
                            <i class="bi bi-navigation-fill"></i>
                            Cómo Llegar
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <small style="font-size:.68rem; color:#aaa;">
            <i class="bi bi-info-circle me-1"></i>
            Los botones abren la app correspondiente en tu dispositivo con el destino ya configurado.
        </small>
    </div>

    {{-- ============================================================ --}}
    {{-- SECCIÓN 3: CLIMA (OpenWeatherMap API)                       --}}
    {{-- ============================================================ --}}
    <div class="mb-5">
        <small class="fw-bold text-uppercase d-block mb-3" style="font-size:.62rem; letter-spacing:3px; color:#f0a500;">
            <i class="bi bi-cloud-sun me-1"></i> Clima Actual — OpenWeatherMap API
        </small>

        <div id="clima-card" style="border:1px solid #e0e0e0; border-left:4px solid #f0a500; background:#fff; min-height:80px; display:flex; align-items:center; padding:1.5rem;">
            <div id="clima-loading" style="color:#aaa; font-style:italic; font-size:.85rem;">
                <i class="bi bi-arrow-repeat me-2"></i>Cargando clima...
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- SECCIÓN 4: MAPA INTERACTIVO (Google Maps API)               --}}
    {{-- ============================================================ --}}
    <div class="mb-4">
        <small class="fw-bold text-uppercase d-block mb-3" style="font-size:.62rem; letter-spacing:3px; color:#f0a500;">
            <i class="bi bi-pin-map me-1"></i> Mapa Interactivo — Google Maps API
        </small>

        <div class="d-flex gap-3 mb-3 flex-wrap align-items-center">
            <span class="d-flex align-items-center gap-2" style="font-size:.75rem; color:#555;">
                <span style="width:12px;height:12px;background:#f0a500;border-radius:50%;border:2px solid #000;display:inline-block;"></span>
                Tianguis principal
            </span>
            <span class="d-flex align-items-center gap-2" style="font-size:.75rem; color:#555;">
                <span style="width:12px;height:12px;background:#111;border-radius:50%;border:2px solid #f0a500;display:inline-block;"></span>
                Locales con ubicación registrada
            </span>
            <small style="font-size:.7rem; color:#aaa; margin-left:auto;">
                <i class="bi bi-cursor me-1"></i>Haz clic en un marcador para ver info
            </small>
        </div>

        <div id="mapa-interactivo" style="height:480px; border:1px solid #ddd; border-top:3px solid #f0a500;"></div>

        <div class="mt-3 d-flex gap-2 justify-content-end flex-wrap">
            <a href="https://www.google.com/maps/search/?api=1&query=19.2895,-98.4395"
               target="_blank"
               class="btn btn-sm fw-bold text-uppercase rounded-0 text-dark"
               style="background:#f0a500; font-size:.68rem; letter-spacing:1px;">
                <i class="bi bi-map-fill me-1"></i> Abrir en Google Maps
            </a>
            <a href="https://waze.com/ul?ll=19.2895,-98.4395&navigate=yes"
               target="_blank"
               class="btn btn-sm fw-bold text-uppercase rounded-0"
               style="background:#111; color:#f0a500; font-size:.68rem; letter-spacing:1px;">
                <i class="bi bi-signpost-2-fill me-1"></i> Abrir en Waze
            </a>
        </div>
    </div>

</div>

{{-- ============================================================ --}}
{{-- SCRIPT: OpenWeatherMap API                                   --}}
{{-- ============================================================ --}}
<script>
(function () {
    var key = '{{ $openWeatherKey }}';
    var lat = 19.2895, lon = -98.4395;

    if (!key || key === 'TU_CLAVE_OPENWEATHER_AQUI') {
        document.getElementById('clima-loading').innerHTML =
            '<i class="bi bi-exclamation-triangle me-2" style="color:#f0a500;"></i>' +
            'Configura <code>OPENWEATHER_API_KEY</code> en el archivo <code>.env</code>.';
        return;
    }

    fetch('https://api.openweathermap.org/data/2.5/weather?lat='+lat+'&lon='+lon+'&appid='+key+'&units=metric&lang=es')
        .then(function(r){ return r.json(); })
        .then(function(d) {
            if (d.cod && d.cod !== 200) throw new Error(d.message);

            var wc   = d.weather[0];
            var main = d.main;
            var wind = d.wind;
            var isDay = wc.icon.endsWith('d');

            var condIconMap = {
                '01':'bi-sun', '02':'bi-cloud-sun', '03':'bi-cloud', '04':'bi-clouds',
                '09':'bi-cloud-drizzle', '10':'bi-cloud-rain', '11':'bi-cloud-lightning-rain',
                '13':'bi-snow', '50':'bi-fog'
            };
            var code2 = wc.icon.replace('d','').replace('n','');
            var bsIcon = condIconMap[code2] || 'bi-cloud';

            var html =
                '<div class="row g-0 align-items-center w-100">' +
                  '<div class="col-auto me-4 text-center">' +
                    '<i class="bi '+bsIcon+'" style="font-size:3.5rem; color:#f0a500;"></i>' +
                    '<div class="fw-bold text-dark mt-1 text-capitalize" style="font-size:.72rem;">'+wc.description+'</div>' +
                  '</div>' +
                  '<div class="col-auto me-5">' +
                    '<div class="fw-black" style="font-size:3.2rem; line-height:1; color:#111;">' +
                        Math.round(main.temp)+'<span style="font-size:1.4rem; font-weight:400; color:#888;">°C</span>' +
                    '</div>' +
                    '<small style="color:#aaa; font-size:.68rem; text-transform:uppercase; letter-spacing:1px;">San Martín Texmelucan</small>' +
                  '</div>' +
                  '<div class="col">' +
                    '<div class="row g-3">' +
                      '<div class="col-6 col-md-3">' +
                        '<small class="text-uppercase fw-bold d-block" style="font-size:.58rem; color:#aaa; letter-spacing:1px;">Sensación</small>' +
                        '<span class="fw-bold" style="font-size:.9rem;">'+Math.round(main.feels_like)+'°C</span>' +
                      '</div>' +
                      '<div class="col-6 col-md-3">' +
                        '<small class="text-uppercase fw-bold d-block" style="font-size:.58rem; color:#aaa; letter-spacing:1px;">Humedad</small>' +
                        '<span class="fw-bold" style="font-size:.9rem;">'+main.humidity+'%</span>' +
                      '</div>' +
                      '<div class="col-6 col-md-3">' +
                        '<small class="text-uppercase fw-bold d-block" style="font-size:.58rem; color:#aaa; letter-spacing:1px;">Viento</small>' +
                        '<span class="fw-bold" style="font-size:.9rem;">'+Math.round(wind.speed*3.6)+' km/h</span>' +
                      '</div>' +
                      '<div class="col-6 col-md-3">' +
                        '<small class="text-uppercase fw-bold d-block" style="font-size:.58rem; color:#aaa; letter-spacing:1px;">Mín / Máx</small>' +
                        '<span class="fw-bold" style="font-size:.9rem;">'+Math.round(main.temp_min)+'° / '+Math.round(main.temp_max)+'°</span>' +
                      '</div>' +
                    '</div>' +
                  '</div>' +
                '</div>';

            document.getElementById('clima-card').innerHTML = html;
        })
        .catch(function(err) {
            document.getElementById('clima-loading').innerHTML =
                '<i class="bi bi-exclamation-circle me-2" style="color:#f0a500;"></i>' +
                'La clave de clima aún se está activando — OpenWeatherMap tarda hasta 2 horas en activar claves nuevas. ' +
                '<a href="https://openweathermap.org/api_keys" target="_blank" style="color:#f0a500;">Ver mis claves</a>';
        });
})();
</script>

{{-- ============================================================ --}}
{{-- SCRIPT: Google Maps JavaScript API                           --}}
{{-- ============================================================ --}}
<script>
    var LOCALES_JSON = @json($locales);
    var GMAPS_KEY    = '{{ $googleMapsKey }}';
</script>

@if($googleMapsKey && $googleMapsKey !== 'TU_CLAVE_GOOGLE_MAPS_AQUI')
<script>
function initMap() {
    var centro = { lat: 19.2895, lng: -98.4395 };

    var estiloMapa = [
        { featureType:'poi', stylers:[{visibility:'off'}] },
        { featureType:'transit', stylers:[{visibility:'simplified'}] },
        { elementType:'geometry', stylers:[{color:'#f5f5f5'}] },
        { elementType:'labels.icon', stylers:[{visibility:'off'}] },
        { featureType:'road', elementType:'geometry', stylers:[{color:'#ffffff'}] },
        { featureType:'road.arterial', elementType:'labels.text.fill', stylers:[{color:'#757575'}] },
        { featureType:'water', elementType:'geometry', stylers:[{color:'#c9c9c9'}] },
        { featureType:'water', elementType:'labels.text.fill', stylers:[{color:'#9e9e9e'}] }
    ];

    var map = new google.maps.Map(document.getElementById('mapa-interactivo'), {
        zoom: 16,
        center: centro,
        styles: estiloMapa,
        mapTypeControl: false,
        streetViewControl: false,
        fullscreenControl: true
    });

    // Marcador del Tianguis (amarillo)
    var iconPrincipal = {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 12,
        fillColor: '#f0a500',
        fillOpacity: 1,
        strokeColor: '#000',
        strokeWeight: 2
    };

    var markerPrincipal = new google.maps.Marker({
        position: centro,
        map: map,
        title: 'Tianguis San Martín Texmelucan',
        icon: iconPrincipal,
        zIndex: 999
    });

    var infoPrincipal = new google.maps.InfoWindow({
        content:
            '<div style="font-family:system-ui,sans-serif; padding:4px 2px;">' +
            '<div style="font-weight:700; font-size:.85rem; border-bottom:2px solid #f0a500; padding-bottom:4px; margin-bottom:6px;">Tianguis SMT</div>' +
            '<div style="font-size:.75rem; color:#555;">San Martín Texmelucan, Puebla</div>' +
            '<div style="font-size:.7rem; color:#aaa; margin-top:4px;">19.2895° N, 98.4395° O</div>' +
            '</div>'
    });
    markerPrincipal.addListener('click', function(){ infoPrincipal.open(map, markerPrincipal); });

    // Marcadores de locales (oscuros)
    var iconLocal = {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 8,
        fillColor: '#111111',
        fillOpacity: 1,
        strokeColor: '#f0a500',
        strokeWeight: 2
    };

    LOCALES_JSON.forEach(function(local) {
        var marker = new google.maps.Marker({
            position: { lat: parseFloat(local.latitud), lng: parseFloat(local.longitud) },
            map: map,
            title: local.nombre,
            icon: iconLocal
        });

        var infoWindow = new google.maps.InfoWindow({
            content:
                '<div style="font-family:system-ui,sans-serif; padding:4px 2px; min-width:160px;">' +
                '<div style="font-weight:700; font-size:.82rem; border-bottom:2px solid #f0a500; padding-bottom:4px; margin-bottom:6px;">'+local.nombre+'</div>' +
                '<div style="font-size:.7rem; background:#111; color:#f0a500; display:inline-block; padding:1px 6px; margin-bottom:4px;">'+local.categoria+'</div>' +
                '<div style="font-size:.72rem; color:#555; margin-top:2px;"><span style="color:#f0a500;">&#x25A0;</span> '+local.ubicacion+'</div>' +
                '</div>'
        });

        marker.addListener('click', function(){ infoWindow.open(map, marker); });
    });
}
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{ $googleMapsKey }}&callback=initMap&language=es&region=MX">
</script>
@else
<script>
document.getElementById('mapa-interactivo').innerHTML =
    '<div style="display:flex;align-items:center;justify-content:center;height:100%;flex-direction:column;gap:.5rem;color:#aaa;">' +
    '<i class="bi bi-map" style="font-size:2.5rem;"></i>' +
    '<p style="font-size:.8rem;margin:0;">Configura <code>GOOGLE_MAPS_API_KEY</code> en <code>.env</code></p>' +
    '</div>';
</script>
@endif

@endsection
