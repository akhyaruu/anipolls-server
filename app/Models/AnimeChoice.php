<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimeChoice extends Model
{
   use HasFactory;
   public $timestamps = false;

   public function anime()
   {
      return $this->hasMany(Anime::class);
   }
   
   public function vote()
   {
      return $this->hasMany(Vote::class);
   }
}