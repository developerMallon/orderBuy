<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbFiliais extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('tbFiliais', function (Blueprint $table) {
      $table->id();
      $table->string('nome');
      $table->string('cnpj');
      $table->string('ie');
      $table->string('rua');
      $table->string('numero');
      $table->string('bairro');
      $table->string('cidade');
      $table->char('uf', 2);
      $table->text('obs');
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
    Schema::dropIfExists('tbFiliais');
  }
}
