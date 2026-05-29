<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('vendedores', function (Blueprint $table) {
        $table->string('foto')->nullable()->after('email'); // Agregamos la columna foto

        // También agregamos updated_at porque vi en tu error que el sistema intenta guardarlo y tu tabla no lo tenía
        if (!Schema::hasColumn('vendedores', 'updated_at')) {
            $table->timestamp('updated_at')->nullable();
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendedores', function (Blueprint $table) {
            //
        });
    }
};
