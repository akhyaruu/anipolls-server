@extends('layouts.dashboard')
@section('nav-polls', 'active')

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
         <button type="button" class="btn btn-primary">Tambah Polling</button>
         <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalSeason">Atur Season</button>
      </div>
   </div>

   <div class="row">
      <div class="d-flex">
         <div class="w-100">
            <div class="row">
               <div class="col-sm-4">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title mb-4">Kunjungan</h5>
                        <h1 class="mt-1 mb-3">2.382</h1>
                        <div class="mb-1">
                           <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                           <span class="text-muted">Since last week</span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title mb-4">Total Anime</h5>
                        <h1 class="mt-1 mb-3">14.212</h1>
                        <div class="mb-1">
                           <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25% </span>
                           <span class="text-muted">Since last week</span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title mb-4">Form Submit</h5>
                        <h1 class="mt-1 mb-3">$21.300</h1>
                        <div class="mb-1">
                           <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65% </span>
                           <span class="text-muted">Since last week</span>
                        </div>
                     </div>
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
               <div class="chart chart-sm">
                  <canvas id="chartjs-dashboard-line"></canvas>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="row">
      <div>
         <h6 class="mb-3"><i class="align-middle" data-feather="trending-up"></i> Statistik</h6>
      </div>

      <div class="col-12 col-md-6 col-xxl-3 py-2 d-flex">
         <div class="card flex-fill">
            <div class="card-header">

               <h5 class="card-title mb-0">Usia (pie chart)</h5>
            </div>
            <div class="card-body py-1 d-flex">
               <div class="align-self-center w-100">
                  <div class="chart">
                     <div id="datetimepicker-dashboard"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>  

      <div class="col-12 col-md-6 col-xxl-3 py-2 d-flex">
         <div class="card flex-fill">
            <div class="card-header">

               <h5 class="card-title mb-0">Usia (pie chart)</h5>
            </div>
            <div class="card-body py-1 d-flex">
               <div class="align-self-center w-100">
                  <div class="chart">
                     <div id="datetimepicker-dashboard"></div>
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
               <h5 class="card-title mb-0">Negara (bar chart top 10)</h5>
            </div>
            <div class="card-body py-3">
               <div class="chart chart-sm">
                  <canvas id="chartjs-dashboard-line"></canvas>
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
         <div class="bg-white py-3 px-3 shadow rounded">
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
               <tbody>
                  <tr>
                     <th scope="row">1</th>
                     <td>Horimiya</td>
                     <td>CloverWorks</td>
                     <td>Semi</td>
                     <td>2017</td>
                     <td>2017</td>
                     <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditAnime">Edit</button>
                        <button type="button" class="btn btn-outline-danger">Hapus</button>
                     </td>
                  </tr>
                 
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
            <form action="">
               <div class="row">
                  <div class="col-md-6">
                     <select class="form-select" aria-label="Default select example">
                        <option selected>Pilih Season</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                     </select>
                  </div>
                  <div class="col-md-6">
                     <select class="form-select" aria-label="Default select example">
                        <option selected>Pilih Tahun</option>
                        <option value="1">2017</option>
                        <option value="2">2018</option>
                        <option value="3">2019</option>
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
            ...
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
         </div>
      </div>
      </div>
   </div>



@endsection

@section('custom-script')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
<script>
   $(document).ready( function () {
      $('#list-anime').DataTable();
   });
</script>
@endsection