<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\AnimeChoice;
use App\Models\Anime;
use App\Models\Vote;

class ApiController extends Controller
{
   public function getAnime()
   {
      $anime = Anime::all();
      return response()->json(['anime' => $anime]);
   }

   public function submitVote(Request $request)
   {  
      $vote = new Vote;
      $vote->gender = $request->input('gender');
      $vote->usia = $request->input('usia');
      $vote->save();
      
      $data = $request->input('anime');
      foreach ($data as $value) {
         $choice = new AnimeChoice;
         $choice->anime_id = $value;
         $choice->vote_id = $vote->id;
         $choice->save();
      }
   
   }

}