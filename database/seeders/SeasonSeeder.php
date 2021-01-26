<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Season;

class SeasonSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      Season::create([
         'nama'   => 'semi'
      ]);
      Season::create([
         'nama'   => 'panas'
      ]);
      Season::create([
         'nama'   => 'gugur'
      ]);
      Season::create([
         'nama'   => 'dingin'
      ]);
   }
}