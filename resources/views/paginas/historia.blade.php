@extends('layouts.app')

@section('content')
<div class="bg-black text-white py-5">
    <div class="container text-center">
        <h1 class="display-4 fw-bold text-uppercase tracking-wider">Nuestra Historia</h1>
        <p class="text-secondary lead">EL TIANGUIS DE SAN MARTÍN TEXMELUCAN</p>
    </div>
</div>

<div class="container my-5">
    <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="ratio ratio-4x3 bg-secondary shadow-lg border border-5 border-white d-flex align-items-center justify-content-center">
                 <img src="{{ asset('assets/img/Img.png') }}" 
     class="img-fluid shadow-lg border border-5 border-white" 
     alt="Fotografía Histórica del Tianguis">
            </div>
        </div>
        <div class="col-md-6">
            <h3 class="text-uppercase fw-bold border-start border-4 border-dark ps-3 mb-4">Más de 30 años de tradición</h3>
            <p class="text-muted text-justify">
                El Tianguis de San Martín Texmelucan es considerado uno de los mercados sobre ruedas más grandes de Latinoamérica. 
                Lo que comenzó como un pequeño intercambio comercial entre locales, se ha transformado en un gigante logístico.
            </p>
            <p class="text-muted text-justify">
                Históricamente, este espacio ha sido motor económico de la región, destacando por la venta de textiles, 
                calzado y productos de temporada.
            </p>
        </div>
    </div>
</div>
@endsection