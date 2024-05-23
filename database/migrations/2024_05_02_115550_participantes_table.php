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
        Schema::create('participantes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cedula')->unique();
            $table->integer('circulo_id')->unsigned();
            $table->foreign('circulo_id')->references('id')->on('circulos');
            $table->string('primer_nombre',50);
            $table->string('segundo_nombre',50);
            $table->string('primer_apellido',50);
            $table->string('segundo_apellido',50);
            $table->date('fecha_nacimiento');
            $table->string('sexo',1);
            $table->integer('estado_civil_id')->unsigned();
            $table->foreign('estado_civil_id')->references('id')->on('estado_civil');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->index('cedula');
            $table->index('circulo_id');
            $table->index('fecha_nacimiento');
            $table->index('sexo');
            $table->index('estado_civil_id');
            $table->index(['id','cedula','circulo_id','fecha_nacimiento','sexo','estado_civil_id']);
            $table->softDeletes();
        }); 
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participantes', function (Blueprint $table) {
            $table->dropUnique('participantes_cedula_unique');
        });
    }
};
