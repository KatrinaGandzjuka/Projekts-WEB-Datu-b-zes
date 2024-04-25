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
        Schema::create('pedagogs_numurs', function (Blueprint $table) {
            $table->foreignId('numurs_id')->constrained()->onDelete('cascade');
            $table->char('pedagogs_id', 12)->charset('ucs2')->collation('ucs2_latvian_ci');
            $table->foreign('pedagogs_id')->references('personasKods')->on('lietotajs');
            $table->primary(['numurs_id', 'pedagogs_id']);
        });

        Schema::create('audzeknis_numurs', function (Blueprint $table) {
            $table->foreignId('numurs_id')->constrained()->onDelete('cascade');
            $table->char('audzeknis_id', 12)->charset('ucs2')->collation('ucs2_latvian_ci');
            $table->foreign('audzeknis_id')->references('personasKods')->on('lietotajs');
            $table->primary(['numurs_id', 'audzeknis_id']);
        });

        Schema::create('kostims_numurs', function (Blueprint $table) {
            $table->foreignId('numurs_id')->constrained()->onDelete('cascade');
            $table->integer('kostims_id');
            $table->foreign('kostims_id')->references('KostimiID')->on('kostimi');
            $table->primary(['numurs_id', 'kostims_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedagogs_numurs');
        Schema::dropIfExists('audzeknis_numurs');
        Schema::dropIfExists('kostims_numurs');
    }
};
