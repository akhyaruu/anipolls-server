<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\Anime;

class AdminController extends Controller
{

   public function indexDashboard()
   {
      return view('index');
   }

   public function indexBerita()
   {
       //
   }

   public function indexTopAnime()
   {
      $season = Season::all();
      return view('topanime', compact('season'));
   }

   public function storeAnime(Request $request)
   {
      $data = $request->input('anime');
      foreach ($data as $data) {
         $anime = new Anime;
         $anime->judul = $data['judul'];
         $anime->studio = $data['studio'];
         $anime->season_id = $request->input('season');
         $anime->tahun = $request->input('tahun');
         $anime->sedang_tayang = true;
         $anime->save();
      }
      return response()->json(['message' => 'Data berhasil masuk']);
   }

   public function indexKarakter()
   {
       //
   }

   public function indexPasangan()
   {
       //
   }




   
   public function create()
   {
       //
   }

   public function store(Request $request)
   {
       //
   }

   public function show($id)
   {
       //
   }

   public function edit($id)
   {
       //
   }

   public function update(Request $request, $id)
   {
       //
   }

   public function destroy($id)
   {
       //
   }
}