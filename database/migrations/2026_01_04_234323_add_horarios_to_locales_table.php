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
    Schema::table('locales', function (Blueprint $table) { // Asegúrate que 'locales' sea el nombre real de tu tabla
        $table->string('dias_laborales')->default('Lunes a Domingo')->after('ubicacion'); // Ej. Lunes a Viernes
        $table->time('hora_apertura')->nullable()->after('dias_laborales');
        $table->time('hora_cierre')->nullable()->after('hora_apertura');
    });
}
            //
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locales', function (Blueprint $table) {
            //
        });
    }
};
