<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\AnimeChoice;
use App\Models\Season;
use App\Models\Anime;
use App\Models\Vote;
use App\Models\Post;

class AdminController extends Controller
{

   public function indexDashboard()
   {
      return view('index');
   }

   public function indexTopAnime()
   {
      $anime = Anime::where('sedang_tayang', true)->get();
      $tahun = Anime::select('tahun')->groupBy('tahun')->get();
      $season = DB::table('animes')->join('seasons', 'animes.season_id', '=', 'seasons.id')->select('animes.season_id','seasons.nama')->groupBy('animes.season_id')->get();
      $seasonAll = Season::all();
      $formSubmit = Vote::count();
      return view('topanime', compact('season','anime','tahun','seasonAll','formSubmit'));
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
         $request->file('poster')->storeAs('public', $namaGambar);
         Anime::where('id', $request->idanime)->update(['poster' => $namaGambar]);
      } else {
         return response()->json('Pastikan kamu memasukan file poster terlebih dahulu');
      }
   }

   public function getStatistic() 
   {
      $genderL = DB::table('votes')->join('anime_choices', 'votes.id', '=', 'anime_choices.vote_id')
         ->join('animes', 'anime_choices.anime_id', '=', 'animes.id')->select('gender')->where('animes.sedang_tayang', 'true')
         ->where('gender', 'L')->groupBy('gender')->distinct('vote_id')->count();
      $genderP = DB::table('votes')->join('anime_choices', 'votes.id', '=', 'anime_choices.vote_id')
         ->join('animes', 'anime_choices.anime_id', '=', 'animes.id')->select('gender')->where('animes.sedang_tayang', 'true')
         ->where('gender', 'P')->groupBy('gender')->distinct('vote_id')->count();
      $gender = [$genderL, $genderP];

      $usia1 = DB::table('votes')->join('anime_choices', 'votes.id', '=', 'anime_choices.vote_id')
         ->join('animes', 'anime_choices.anime_id', '=', 'animes.id')->select('usia')->where('animes.sedang_tayang', 'true')
         ->where('usia', '14-')->groupBy('usia')->distinct('vote_id')->count();
      $usia2 = DB::table('votes')->join('anime_choices', 'votes.id', '=', 'anime_choices.vote_id')
         ->join('animes', 'anime_choices.anime_id', '=', 'animes.id')->select('usia')->where('animes.sedang_tayang', 'true')
         ->where('usia', '16-24')->groupBy('usia')->distinct('vote_id')->count();
      $usia3 = DB::table('votes')->join('anime_choices', 'votes.id', '=', 'anime_choices.vote_id')
         ->join('animes', 'anime_choices.anime_id', '=', 'animes.id')->select('usia')->where('animes.sedang_tayang', 'true')
         ->where('usia', '24+')->groupBy('usia')->distinct('vote_id')->count();
      $usia = [$usia1, $usia2, $usia3];

      $getCurrentAiringAnime = Anime::where('sedang_tayang', 'true')->get();
      $topAnime = $this->getTopAnime($getCurrentAiringAnime);

      return response()->json(compact('gender','usia','topAnime'));
   }

   private function getTopAnime($currentAnime)
   {
      $topAnime = [];
      foreach ($currentAnime as $anime) {
         $countResult = DB::table('animes')->join('anime_choices', 'animes.id', '=', 'anime_choices.anime_id')
            ->where('anime_choices.anime_id', $anime['id'])->count();
         array_push($topAnime, ['judul' => $anime['judul'], 'nilai' => $countResult]);
      }
      return $topAnime;
   }

   public function deleteAnime(Request $request)
   {
      Anime::find($request->animeid)->delete();
      return back()->with('success', 'Anime berhasil dihapus');
   }

   
   public function indexBerita()
   {
      return view('berita');
   }

   public function storeBerita(Request $request)
   {
      if($request->hasFile('gambar')) {
         $request->validate([
            'gambar'  => 'required|image|mimes:jpeg,png,jpg|max:2048'
         ]);
         $ekstensi = $request->gambar->getClientOriginalExtension();
         $namaGambar  = 'berita-'.time(). '.' .$ekstensi;
         $request->file('gambar')->storeAs('public/berita', $namaGambar);

         $post = new Post;
         $post->judul = $request->judul;
         $post->isi = $request->berita;
         $post->gambar = $namaGambar;
         $post->created_at = date('d F Y');
         $post->updated_at = date('d F Y');
         $post->save();
         return back()->with('success', 'Berita berhasil diupload');
      } else {
         return back()->with('fail', 'Gagal diupload!');
      }

     
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