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
        Schema::dropIfExists('circulos');
        Schema::create('circulos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')->references('id')->on('cne_estados');
            $table->integer('municipio_id')->unsigned();
            $table->foreign('municipio_id')->references('id')->on('cne_municipios');
            $table->integer('parroquia_id')->unsigned();
            $table->foreign('parroquia_id')->references('id')->on('cne_parroquias');
            $table->string('circulo', 50);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->index('estado_id');
            $table->index('municipio_id');
            $table->index('parroquia_id');
            $table->index(['id','estado_id', 'municipio_id','parroquia_id']);            
            $table->softDeletes();
        });     
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
