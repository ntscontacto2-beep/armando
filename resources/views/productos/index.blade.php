@extends('layouts.app')

@section('content')

    <div style="padding-top: 100px; padding-bottom: 50px; background-color: #f8f9fa;">
        <div class="container mx-auto" style="max-width: 1200px; padding: 0 20px;">

            <div style="border-bottom: 2px solid #000; margin-bottom: 30px; padding-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
                <h1 style="font-size: 1.8rem; font-weight: 800; color: #000; text-transform: uppercase; letter-spacing: 1px; margin: 0;">
                    CONTROL DE INVENTARIO
                </h1>
                <span style="color: #666; font-size: 0.9rem;">HOUSE FIX</span>
            </div>

            <div style="background: white; border: 1px solid #ddd; padding: 25px; margin-bottom: 30px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                <h3 style="font-size: 1.1rem; font-weight: bold; color: #333; margin-bottom: 20px; text-transform: uppercase;">
                    NUEVA REFACCIÓN
                </h3>
                
                <form action="{{ route('productos.store') }}" method="POST">
                    @csrf
                    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                        
                        <div style="flex: 2; min-width: 300px;">
                            <label style="display: block; font-weight: bold; font-size: 0.8rem; color: #555; margin-bottom: 5px; text-transform: uppercase;">NOMBRE DEL PRODUCTO</label>
                            <input type="text" name="nombre" 
                                   style="width: 100%; padding: 10px; border: 1px solid #ccc; background-color: #f9f9f9; font-size: 0.95rem;"
                                   placeholder="EJ. PANTALLA IPHONE X" required>
                        </div>

                        <div style="flex: 1; min-width: 120px;">
                            <label style="display: block; font-weight: bold; font-size: 0.8rem; color: #555; margin-bottom: 5px; text-transform: uppercase;">CANTIDAD</label>
                            <input type="number" name="cantidad" 
                                   style="width: 100%; padding: 10px; border: 1px solid #ccc; background-color: #f9f9f9; font-size: 0.95rem;"
                                   placeholder="0" required>
                        </div>

                        <div style="flex: 1; min-width: 120px;">
                            <label style="display: block; font-weight: bold; font-size: 0.8rem; color: #555; margin-bottom: 5px; text-transform: uppercase;">PRECIO VENTA</label>
                            <input type="number" step="0.01" name="precio_venta" 
                                   style="width: 100%; padding: 10px; border: 1px solid #ccc; background-color: #f9f9f9; font-size: 0.95rem;"
                                   placeholder="$0.00" required>
                        </div>

                        <input type="hidden" name="stock_minimo" value="5">
                        <input type="hidden" name="precio_costo" value="0">
                    </div>

                    <div style="margin-top: 20px; text-align: right;">
                        <button type="submit" 
                                style="background-color: #000; color: white; padding: 12px 30px; border: none; font-weight: bold; text-transform: uppercase; font-size: 0.85rem; cursor: pointer; letter-spacing: 1px;">
                            GUARDAR REGISTRO
                        </button>
                    </div>
                </form>
            </div>

            <div style="background: white; border: 1px solid #ddd; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                <div style="padding: 15px 25px; border-bottom: 1px solid #eee; background-color: #f4f4f4;">
                    <h3 style="font-size: 1rem; font-weight: bold; color: #333; margin: 0; text-transform: uppercase;">LISTADO DE EXISTENCIAS</h3>
                </div>

                @if($productos->isEmpty())
                    <div style="padding: 40px; text-align: center; color: #777;">
                        <p style="font-style: italic;">No hay productos registrados en el sistema.</p>
                    </div>
                @else
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #fff; border-bottom: 2px solid #000;">
                                <th style="padding: 15px; text-align: left; font-size: 0.8rem; font-weight: bold; color: #000; text-transform: uppercase;">PRODUCTO</th>
                                <th style="padding: 15px; text-align: center; font-size: 0.8rem; font-weight: bold; color: #000; text-transform: uppercase;">PRECIO</th>
                                <th style="padding: 15px; text-align: center; font-size: 0.8rem; font-weight: bold; color: #000; text-transform: uppercase;">STOCK</th>
                                <th style="padding: 15px; text-align: center; font-size: 0.8rem; font-weight: bold; color: #000; text-transform: uppercase;">AJUSTE RÁPIDO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $producto)
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 15px; color: #333;">
                                    <span style="font-weight: bold; font-size: 1rem; display: block;">{{ $producto->nombre }}</span>
                                    @if($producto->cantidad <= 5)
                                        <span style="font-size: 0.75rem; color: #d9534f; font-weight: bold; text-transform: uppercase;">STOCK BAJO</span>
                                    @endif
                                </td>
                                <td style="padding: 15px; text-align: center; font-weight: 500;">
                                    ${{ number_format($producto->precio_venta, 2) }}
                                </td>
                                <td style="padding: 15px; text-align: center;">
                                    <span style="display: inline-block; padding: 4px 12px; font-size: 0.85rem; font-weight: bold; color: #fff; background-color: {{ $producto->cantidad <= 5 ? '#333' : '#000' }};">
                                        {{ $producto->cantidad }}
                                    </span>
                                </td>
                                <td style="padding: 15px; text-align: center;">
                                    <div style="display: flex; justify-content: center; gap: 5px;">
                                        <form action="{{ route('productos.stock', $producto->id) }}" method="POST">
                                            @csrf <input type="hidden" name="cantidad_movimiento" value="1">
                                            <button type="submit" style="background: #e2e6ea; color: #333; border: 1px solid #ccc; padding: 5px 12px; font-weight: bold; cursor: pointer;">+</button>
                                        </form>
                                        <form action="{{ route('productos.stock', $producto->id) }}" method="POST">
                                            @csrf <input type="hidden" name="cantidad_movimiento" value="-1">
                                            <button type="submit" style="background: #e2e6ea; color: #333; border: 1px solid #ccc; padding: 5px 12px; font-weight: bold; cursor: pointer;">-</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection