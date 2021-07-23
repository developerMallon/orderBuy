<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbVeiculos extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('tbVeiculos', function (Blueprint $table) {
      $table->id();
      $table->char('placa', 7);
      $table->string('veiculo');
      $table->string('renavan')->nullable();
      $table->dateTime('vencimento')->nullable();
      $table->float('valor_doc')->nullable();
      $table->string('responsavel')->nullable();
      $table->string('ano_modelo');
      $table->char('uf',2);
      $table->float('fipe');
      $table->unsignedBigInteger('tbDepartamentos_id');
      $table->foreign('tbDepartamentos_id')->references('id')->on('tbDepartamentos')->onUpdate('cascade')->onDelete('cascade');
      $table->unsignedBigInteger('tbFiliais_id');
      $table->foreign('tbFiliais_id')->references('id')->on('tbFiliais')->onUpdate('cascade')->onDelete('cascade');
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
    Schema::dropIfExists('tbVeiculos');
  }
}
