<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUsuarios extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('tbUsuarios', function (Blueprint $table) {
      $table->id();
      $table->string('nome');
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('senha');
      $table->rememberToken();
      $table->unsignedBigInteger('tbFiliais_id');
      $table->foreign('tbFiliais_id')->references('id')->on('tbFiliais')->onUpdate('cascade')->onDelete('cascade');
      $table->unsignedBigInteger('tbDepartamentos_id');
      $table->foreign('tbDepartamentos_id')->references('id')->on('tbDepartamentos')->onUpdate('cascade')->onDelete('cascade');
      $table->unsignedBigInteger('tbNiveis_id');
      $table->foreign('tbNiveis_id')->references('id')->on('tbNiveis')->onUpdate('cascade')->onDelete('cascade');
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
    Schema::dropIfExists('tbUsuarios');
  }
}
