<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;

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

   public function createAnime(Request $request)
   {
      $result = $request->anime;
      dd($result);
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