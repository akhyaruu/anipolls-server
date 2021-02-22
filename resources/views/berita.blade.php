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
         <h3>Top Anime</h3>
      </div>

   </div>
   <div class="row">
      <form>
         <textarea name="editor1" id="editor1" rows="10" cols="80">
             This is my textarea to be replaced with CKEditor 4.
         </textarea>
         <script>
             // Replace the <textarea id="editor1"> with a CKEditor 4
             // instance, using default configuration.
             CKEDITOR.replace( 'editor1' );
         </script>
     </form>

   </div>

  
</div>
@endsection

@section('custom-script')
<script>

</script>
@endsection