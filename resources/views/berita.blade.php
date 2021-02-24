@extends('layouts.dashboard')
@section('nav-berita', 'active')

@section('custom-css')
<link rel="stylesheet" href="{{ asset('css/grid.css') }}">
<script src="{{ asset("ckeditor/ckeditor.js") }}"></script>
@endsection

@section('content')
<div class="container-fluid p-0">

   <div class="row mb-2 mb-xl-3">
      <div class="col-auto d-none d-sm-block">
         <h3>Berita</h3>
      </div>

      @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show py-3 px-4 mt-3" role="alert">
         {{ session('success') }}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif 
      @if (session('fail'))
      <div class="alert alert-warning alert-dismissible fade show py-3 px-4 mt-3" role="alert">
         {{ session('fail') }}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif 

   </div>
   <div class="row">
      <form action="{{ url('berita/store') }}" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="form-group">
            <label class="form-label">Judul Berita</label>
            <input type="text" name="judul" class="form-control" autocomplete="off" required>
         </div>
         <div class="form-group mt-3">
            <textarea name="berita" id="editor1" rows="10" cols="80" required>
               Tuliskan berita disini.
            </textarea>
         </div>
         <div class="form-group mt-3">
            <label class="form-label">Gambar Berita</label>
            <input type="file" name="gambar" onchange="loadFile1(event)" required>
            <img id="output1" class="w-50 mt-3 mb-3" />
            <script>
            var loadFile1 = function(event) {
                  var output1 = document.getElementById('output1');
                  output1.src = URL.createObjectURL(event.target.files[0]);
                  output1.onload = function() {
                  URL.revokeObjectURL(output1.src)
               }
            };
            </script>
         </div>
         <button type="submit" class="btn btn-primary float-right mt-3">Submit</button>
     </form>

   </div>

  
</div>
@endsection

@section('custom-script')
<script>

CKEDITOR.replace('berita');

</script>
@endsection