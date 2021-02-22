<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimeChoicesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('anime_choices', function (Blueprint $table) {
         $table->id();
         $table->foreignId('anime_id')->constrained('animes')->onDelete('cascade');;
         $table->foreignId('vote_id')->constrained('votes');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
       Schema::dropIfExists('anime_choices');
   }
}