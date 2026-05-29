<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendedor_id')->nullable();
            $table->string('nombre');
            $table->string('slug')->nullable();
            $table->string('categoria')->nullable();
            $table->string('ubicacion')->nullable();
            $table->text('descripcion')->nullable();
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();
            $table->unsignedInteger('visitas')->default(0);
        });

        Schema::create('rutas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->longText('geojson')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rutas');
        Schema::dropIfExists('locales');
    }
};
