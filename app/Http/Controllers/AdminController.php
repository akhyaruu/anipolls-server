<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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
      $anime = Anime::where('sedang_tayang', '=', true)->get();
      $tahun = Anime::select('tahun')->groupBy('tahun')->get();
      $season = DB::table('animes')->join('seasons', 'animes.season_id', '=', 'seasons.id')->select('animes.season_id','seasons.nama')->groupBy('animes.season_id')->get();
      $seasonAll = Season::all();
      return view('topanime', compact('season','anime','tahun','seasonAll'));
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
      Anime::where('season_id', '!=', $request->input('season'))->orWhere('tahun', '!=', $request->input('tahun'))->update(['sedang_tayang' => 'false']);
   }

   public function adjustAnime(Request $request)
   {
      Anime::where('season_id', $request->season)->where('tahun', $request->tahun)->update(['sedang_tayang' => 'true']);
      Anime::where('season_id', '!=', $request->season)->orWhere('tahun', '!=', $request->tahun)->update(['sedang_tayang' => 'false']);
      return back()->with('success', 'Season anime berhasil diubah');
   }

   public function getYear($seasonid)
   {
      $tahun = Anime::select('tahun')->where('season_id', $seasonid)->groupBy('tahun')->get();
      return response()->json($tahun);
   }

   public function storePoster(Request $request)
   {
      if($request->hasFile('poster')) {
         $request->validate([
            'poster'  => 'required|image|mimes:jpeg,png,jpg|max:2048'
         ]);
         $ekstensi = $request->poster->getClientOriginalExtension();
         $namaGambar  = 'anime-'.time(). '.' .$ekstensi;
         $request->file('poster')->storeAs('poster', $namaGambar);
         Anime::where('id', $request->idanime)->update(['poster' => $namaGambar]);
      } else {
         return response()->json('Pastikan kamu memasukan file poster terlebih dahulu');
      }
   }

   // public function jadi()
   // {
      
   //    $vote = new Season;
   //    $vote->nama = 'Berhasil';
   //    $vote->save();
   //    return response()->json('data berhasil masuk');
   // }

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