<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbFiliaisDepartamentos extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('tbFiliaisDepartamentos', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('tbFiliais_id');
      $table->foreign('tbFiliais_id')->references('id')->on('tbFiliais')->onUpdate('cascade')->onDelete('cascade');
      $table->unsignedBigInteger('tbDepartamentos_id');
      $table->foreign('tbDepartamentos_id')->references('id')->on('tbDepartamentos')->onUpdate('cascade')->onDelete('cascade');
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
    Schema::dropIfExists('tbFiliaisDepartamentos');
  }
}
