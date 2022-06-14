<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function( Blueprint $table) {
            $table->id();
            $table->float('sueldo');
            $table->string('duracion', 60)->nullable()->default('indefinido');

            //Foranea
            $table->unsignedBigInteger('tipo_contrato_id')->nullable();
            $table->foreign('tipo_contrato_id')->references('id')->on('tipo_contratos')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
