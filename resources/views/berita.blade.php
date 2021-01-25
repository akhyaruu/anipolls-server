@extends('layouts.app')
@section('nav-polls', 'active')

@section('custom-css')
<link rel="stylesheet" href="{{ asset('css/grid.css') }}"> 
@endsection

@section('content')
<div class="container-fluid p-0">

   <div class="row mb-2 mb-xl-3">
      <div class="col-auto d-none d-sm-block">
         <h3>Top Anime</h3>
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
         <h6 class="mb-3">Statistik</h6>
      </div>

      <div class="col-12 col-md-6 col-xxl-3 py-2 d-flex">
         <div class="card flex-fill">
            <div class="card-header">

               <h5 class="card-title mb-0">Usia (pie chart)</h5>
            </div>
            <div class="card-body d-flex">
               <div class="align-self-center w-100">
                  <div class="chart">
                     <div id="datetimepicker-dashboard"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>  

      <div class="col-12 col-md-6 col-xxl-3 py-2 d-flex">
         <div class="card flex-fill w-100">
            <div class="card-header">

               <h5 class="card-title mb-0">Gender (pie chart)</h5>
            </div>
            <div class="card-body d-flex">
               <div class="align-self-center w-100">
                  <div class="py-3">
                     <div class="chart chart-xs">
                        <canvas id="chartjs-dashboard-pie"></canvas>
                     </div>
                  </div>

                  <table class="table mb-0">
                     <tbody>
                        <tr>
                           <td>Chrome</td>
                           <td class="text-right">4306</td>
                        </tr>
                        <tr>
                           <td>Firefox</td>
                           <td class="text-right">3801</td>
                        </tr>
                        <tr>
                           <td>IE</td>
                           <td class="text-right">1689</td>
                        </tr>
                     </tbody>
                  </table>
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
         <div>
            <h6 class="mb-3">Tambah Anime</h6>
         </div>
   
         <table id="list-anime"></table>
      </div>
   </div>

</div>
@endsection

@section('custom-script')
<script>

</script>
@endsection