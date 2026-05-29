<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void

{
    Schema::create('productos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');                 // Antes name
        $table->text('descripcion')->nullable();  // Antes description
        $table->integer('cantidad')->default(0);  // Antes stock_quantity
        $table->integer('stock_minimo')->default(5); // Antes min_stock
        $table->decimal('precio_costo', 10, 2);   // Antes cost_price
        $table->decimal('precio_venta', 10, 2);   // Antes sale_price
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
