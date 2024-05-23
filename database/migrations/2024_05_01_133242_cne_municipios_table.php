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
        Schema::create('cne_municipios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')->references('id')->on('cne_estados');
            $table->integer('municipio_id');
            $table->string('municipio', 50);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
            $table->index('estado_id');
            $table->index(['estado_id', 'municipio_id']);
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
