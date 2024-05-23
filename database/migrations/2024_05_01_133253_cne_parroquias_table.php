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
        Schema::create('cne_parroquias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')->references('id')->on('cne_municipios');
            $table->integer('municipio_id');
            $table->foreign('municipio_id')->references('id')->on('cne_municipios');
            $table->integer('parroquia_id');
            $table->string('parroquia', 50);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
            $table->index('estado_id');
            $table->index('municipio_id');
            $table->index(['estado_id', 'municipio_id', 'parroquia_id']);
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
