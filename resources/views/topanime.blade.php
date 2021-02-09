@extends('layouts.dashboard')
@section('nav-polls', 'active')

@section('custom-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
@endsection

@section('content')
<div class="container-fluid p-0">

   <div class="row mb-2 mb-xl-3">
      <div class="col-auto d-none d-sm-block">
         <h3>Top Anime</h3>
      </div>

   </div>

   <div class="row mb-3">
      <div>
         <h6 class="mb-3"><i class="align-middle" data-feather="sliders"></i> Kontrol</h6>
      </div>
      <div>
         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Polling</button>
         <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalSeason">Atur Season</button>
      </div>
   </div>

   @if (session('success'))
   <div class="alert alert-success alert-dismissible fade show py-3 px-4" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
   @endif
   {{-- @if (session('fail'))
   <div class="alert alert-danger alert-dismissible fade show py-3 px-4" role="alert">
      {{ session('fail') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
   @endif --}}

   <div class="row">
      <div class="d-flex">
         <div class="w-100">
            <div class="row">
               <div class="col-sm-4">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title mb-4">Kunjungan</h5>
                        <h1 class="mt-1 mb-3">2.382</h1>
                     </div>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title mb-4">Total Anime (musim ini)</h5>
                        <h1 class="mt-1 mb-3">{{ count($anime) }}</h1>
                     </div>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title mb-4">Form Submit</h5>
                        <h1 class="mt-1 mb-3">{{ $formSubmit }}x</h1>
                        {{-- <div class="mb-1">
                           <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65% </span>
                           <span class="text-muted">Since last week</span>
                        </div>
                     </div> --}}
                  </div>
               </div>
            </div>
         </div>
      </div>

   </div>

   <div class="row">
      <div class="">
         <div class="card flex-fill w-100">
            <div class="card-header">
               <h5 class="card-title mb-0">Top Anime</h5>
            </div>
            <div class="card-body py-3">
               <div class="chart chart-sm mb-4">
                  <canvas id="chartanime"></canvas>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="row">
      <div>
         <h6 class="mb-3"><i class="align-middle" data-feather="trending-up"></i> Statistik</h6>
      </div>

      <div class="col-12 col-md-6 col-xxl-3 d-flex">
         <div class="card flex-fill h-75">
            <div class="card-header">
               <h5 class="card-title mb-0">Gender</h5>
            </div>
            <div class="card-body py-1 d-flex">
               <div class="align-self-center w-100">
                  <div class="chart">
                     <canvas id="chartgender"></canvas>
                  </div>
               </div>
            </div>
         </div>
      </div>  

      <div class="col-12 col-md-6 col-xxl-3 d-flex">
         <div class="card flex-fill h-75">
            <div class="card-header">
               <h5 class="card-title mb-0">Usia</h5>
            </div>
            <div class="card-body py-1 d-flex">
               <div class="align-self-center w-100">
                  <div class="chart">
                     <canvas id="chartusia"></canvas>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </div>

   <div class="row">
      <div>
         <h6 class="mb-3"><i class="align-middle" data-feather="list"></i> Daftar Anime</h6>
      </div>

      <div>
         <div class="bg-white px-3 shadow rounded">
            <table class="table" id="list-anime">
               <thead class="table-dark">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Studio</th>
                    <th scope="col">Season</th>
                    <th scope="col">Tahun</th>
                    <th scope="col">Poster</th>
                    <th scope="col">Aksi</th>
                  </tr>
               </thead>
               <tbody id="tBodyAnime">
                  @foreach ($anime as $anime)
                  <tr>
                     <th scope="row">{{ $loop->iteration }}</th>
                     <td>{{ $anime->judul }}</td>
                     <td>{{ $anime->studio }}</td>
                     <td>{{ $anime->season->nama }}</td>
                     <td>{{ $anime->tahun }}</td>
                     @if ($anime->poster)
                     <td><img src="{{ asset('storage/'.$anime->poster) }}" style="max-width: 60px"></td>
                     @else
                     <td><p class="text-danger">tidak ada poster</p></td>
                     @endif
                     <td>
                        <button type="button" class="btn btn-sm btn-primary btn-edit-anime" data-bs-toggle="modal" data-bs-target="#modalEditAnime" value="{{ $anime->id }}">Edit</button>
                        <button type="button" class="btn btn-sm btn-outline-danger">Hapus</button>
                     </td>
                  </tr>
                  @endforeach
                 
               </tbody>
            </table>
         </div>
      </div>


   </div>

</div>


   <!-- Modal atur season -->
   <div class="modal fade" id="modalSeason" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">Atur Season</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form action="{{ url('/poll/top-anime/adjust') }}" method="POST">
               @csrf
               <div class="row">
                  <div class="col-md-6">
                     <select class="form-select" name="season" id="selectSeason">
                        <option selected>Pilih Season</option>
                        @foreach ($season as $s)
                        <option value="{{ $s->season_id }}">Musim {{ $s->nama }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-6">
                     <select class="form-select" name="tahun" id="selectTahun">
                        <option selected>Pilih Tahun</option>
                        @foreach ($tahun as $th)
                        <option value="{{ $th->tahun }}">{{ $th->tahun }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>   
               <div class="mt-4 float-right">
                  <button type="submit" class="btn btn-primary">Simpan</button>
               </div>
            </form>

         </div>
      </div>
      </div>
   </div>

   <!-- Modal edit anime -->
   <div class="modal fade" id="modalEditAnime" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Anime</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form id="formPoster">
               <h5>Masukan poster anime</h5>
               <input id="inputPoster" type="file" name="poster" required>
               <input id="inputIdAnime" type="hidden" name="idanime" value="">
               <div class="mt-4 float-right">
                  <button id="bSubmitPoster" type="submit" class="btn btn-primary">Simpan</button>
               </div>
            </form>
         </div>
      </div>
      </div>
   </div>

   <!-- Modal tambah polling -->
   <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Masukan Anime Musim Ini Untuk Di Polling</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body px-4">
            <form id="formPolling">
               <div class="row">
                  <div class="col-md-6">
                     <label class="form-label">Pilih Season</label>
                     <select class="form-select" id="seasonAnime">
                        @foreach ($seasonAll as $s)
                        <option value="{{ $s->id }}">Musim {{ $s->nama }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-6">
                     <label class="form-label">Masukan Tahun</label>
                     <input id="tahunAnime" class="form-control" type="number" name="tahun" value="{{ date("Y") }}" readonly>
                  </div>
               </div>  
               <h5 class="mt-5 fw-bold text-primary"><b>Masukan Anime</b></h5>
               <div id="barisAnime">
                  <div class="row mt-3">
                     <div class="col-md-6">
                        <label class="form-label">Judul</label>
                        <input class="form-control input-anime" type="text" name="judul" autocomplete="off" required>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Studio</label>
                        <input class="form-control input-anime" type="text" name="studio" autocomplete="off" required>
                     </div>
                  </div>
               </div>
               <div class="mt-3">
                  <button id="bTambahBaris" type="button" class="btn btn-outline-primary">Tambah Baris</button>
               </div>
               <div class="mt-4 float-right">
                  <button id="bSubmitPoll" type="button" class="btn btn-primary">Submit</button>
               </div>
            </form>
         </div>
      </div>
      </div>
   </div>



@endsection

@section('custom-script')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.20/lodash.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script>
   $(document).ready(function() {
      
      axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
      axios.defaults.headers.post['Content-Type'] = 'application/json';

      let inputEmpty;
      let arrAnime = [];
      const formPoster = document.getElementById('formPoster');
      const chartusia = document.getElementById('chartusia').getContext('2d');
      const chartgender = document.getElementById('chartgender').getContext('2d');
      const chartanime = document.getElementById('chartanime').getContext('2d');
      
      axios.get('{{ url("poll/top-anime/getstatistic") }}')
         .then(function (response) {
            var myChartUsia = new Chart(chartusia, {
               type: 'pie',
               data: {
                  datasets: [{
                     data: [...response.data.usia],
                     backgroundColor: [
                        "#dbe2ef", 
                        "#3f72af", 
                        "#112d4e"
                     ]  
                  }],
                  labels: [
                     '16-',
                     '16-24',
                     '24+'
                  ]
               }
            });

            var myChartGender = new Chart(chartgender, {
               type: 'pie',
               data: {
                  datasets: [{
                     data: [...response.data.gender],
                     backgroundColor: [
                        "#4d375d", 
                        "#eb596e"
                     ]  
                  }],
                  labels: [
                     'Laki-laki',
                     'Perempuan'
                  ]
               }
            });

            const topAnime = response.data.topAnime;
            topAnime.sort(function(a, b) {
               return b.nilai - a.nilai;
            });
            const judul = topAnime.map(anime => anime.judul);
            const nilai = topAnime.map(anime => anime.nilai);
            
            var myChartanime = new Chart(chartanime, {
               type: 'horizontalBar',
               data: {
                  labels: judul,
                  datasets: [{
                        label: '',
                        data: nilai,
                        backgroundColor: [
                           'rgba(255, 99, 132, 0.2)',
                           'rgba(54, 162, 235, 0.2)',
                           'rgba(255, 206, 86, 0.2)'
                        ],
                        borderColor: [
                           'rgba(255, 99, 132, 1)',
                           'rgba(54, 162, 235, 1)',
                           'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                  }]
               },
               options: {
                  scales: {
                        yAxes: [{
                           ticks: {
                              beginAtZero: true
                           }
                        }]
                  }
               }
            });
         })
         .catch(function (error) {
            Swal.fire({
               icon: 'error',
               title: 'Terjadi Kesalahan!',
               text: `${error.message}`
            })
         });

      $('#list-anime').DataTable();

      $('#bTambahBaris').click(function() {
         $('#barisAnime').append(` 
            <div class="row mt-3">
               <div class="col-md-6">
                  <label class="form-label">Judul</label>
                  <input class="form-control input-anime" type="text" name="judul" autocomplete="off" required>
               </div>
               <div class="col-md-6">
                  <label class="form-label">Studio</label>
                  <input class="form-control input-anime" type="text" name="studio" autocomplete="off" required>
               </div>
            </div>`);
      });

      // submit poll
      $('#bSubmitPoll').click(function() {
         arrAnime.splice(0, arrAnime.length);
         $("div#barisAnime :input").each(function(){
            inputEmpty = this.value ? false : true;
            arrAnime.push(this.value);
         });

         if(inputEmpty) {
            Swal.fire({
               icon: 'error',
               title: 'Ops...',
               text: 'Pastikan seluruh input telah dimasukan'
            })
         } else {
            const result = _.chunk(arrAnime,2);
            result.unshift(["judul", "studio"]);
            const animeObject = convertToArrayObject(result);

            axios.post('{{ url("poll/top-anime/store") }}', JSON.stringify({
               anime: animeObject,
               season: $('#seasonAnime').val(),
               tahun: $('#tahunAnime').val(),
            }) )
            .then(function (response) {
               Swal.fire(
                  'Data Berhasil Masuk',
                  'Jangan lupa mengupload tiap poster anime terlebih dahulu',
                  'success'
               );
            })
            .catch(function (error) {
               Swal.fire({
                  icon: 'error',
                  title: 'Terjadi Kesalahan!',
                  text: `${error.message}`
               })
            });
         }
      });

      // pilih season
      $('#selectSeason').change(function() {
         const seasonid = $('#selectSeason').val();
         axios.get(`{{ url('') }}/poll/top-anime/get-year/`+seasonid)
         .then(function (response) {
            $('#selectTahun').empty();
            let output = '';
            response.data.map(data => {
               output+=`<option value="${data.tahun}">${data.tahun}</option>`;
            });
            $('#selectTahun').append(`
               <option selected>Pilih Tahun</option>
               ${output}
            `);
         })
         .catch(function (error) {
            Swal.fire({
               icon: 'error',
               title: 'Terjadi Kesalahan!',
               text: `${error.message}`
            })
         })
      });

      $("#tBodyAnime").on("click", "button.btn-edit-anime", function() {
         $("#inputIdAnime").val(this.value);
      });

      // submit poster
      $('#formPoster').submit(function(e) {
         e.preventDefault();
         axios({
            method: 'post',
            url: '{{ url("/poll/top-anime/store-poster") }}',
            data: new FormData(formPoster),
            headers: {'Content-Type': 'multipart/form-data' }
         })
         .then(function (response) {
            Swal.fire({
               icon: 'success',
               title: 'Berhasil',
               text: 'Poster berhasil di upload'
            })
            $('#inputPoster').val('');
         })
         .catch(function (error) {
            Swal.fire({
               icon: 'error',
               title: 'Terjadi Kesalahan!',
               text: `${error.message}`
            })
         });
      });

      
      


      




   });
</script>
@endsection