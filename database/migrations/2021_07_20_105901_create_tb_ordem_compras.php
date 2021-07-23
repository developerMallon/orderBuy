<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbOrdemCompras extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('tbOrdemCompras', function (Blueprint $table) {
      $table->id();
      $table->string('solicitante');
      $table->string('motivo');
      $table->integer('km');
      $table->integer('valor');
      $table->unsignedBigInteger('tbFiliais_id');
      $table->foreign('tbFiliais_id')->references('id')->on('tbFiliais')->onUpdate('cascade')->onDelete('cascade');
      $table->unsignedBigInteger('tbDepartamentos_id');
      $table->foreign('tbDepartamentos_id')->references('id')->on('tbDepartamentos')->onUpdate('cascade')->onDelete('cascade');
      $table->unsignedBigInteger('tbUsuarios_id');
      $table->foreign('tbUsuarios_id')->references('id')->on('tbUsuarios')->onUpdate('cascade')->onDelete('cascade');
      $table->unsignedBigInteger('tbTipos_id');
      $table->foreign('tbTipos_id')->references('id')->on('tbTipos')->onUpdate('cascade')->onDelete('cascade');
      $table->unsignedBigInteger('tbVeiculos_id');
      $table->foreign('tbVeiculos_id')->references('id')->on('tbVeiculos')->onUpdate('cascade')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('tbOrdemCompras');
  }
}
