@extends('templates/index')
@section('judul-page')
Form Merk
@endsection

@section('judul')
<i class="fa fa-plus"></i>
Form Merk
@endsection
@section('small-judul')
Edit
@endsection

@section('keterangan-halaman')
Field jangan sampai kosong.
@endsection

@section('content')
<?php $action = $pathLink.'update'; ?>
<div class="form">
  @include($pathView.'_form')
</div>
@endsection
