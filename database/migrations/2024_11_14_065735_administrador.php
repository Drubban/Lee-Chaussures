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
        Schema::create('administrador', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idProducto');
            $table->unsignedBigInteger('userId');
            $table->string('token');
            $table->unsignedBigInteger('idEmpleado');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idProducto')->references('id')->on('producto')->onDelete('cascade');
            $table->foreign('idEmpleado')->references('id')->on('trabajador')->onDelete('cascade');
            
            
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrador');
    }
};
