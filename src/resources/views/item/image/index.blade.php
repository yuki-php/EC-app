@extends('layouts.base')

@section('title', '商品詳細')

@section('css')
<link href="{{ asset('css/item.css') }}" rel="stylesheet">
@endsection

@section('head_script')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('headline')
<h1 class="border-bottom pb-2 mb-3"><small>商品画像</small></h1>
@endsection

@section('content')

@if (session('success'))
  <div class="alert alert-success" role="alert">
  {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

<div  class='container mt-3'>
  <div class='row mb-5'>
    <div class='col-6'>
      <center><p class='mb-0 font-weight-bold align-middle'>品番:{{$item->cm_number ?? $item->maker_code}}</p></center>
    </div>
    <div class='col-6'>
      <center>
        <p class='mx-auto mb-0 font-weight-bold'>商品名:{{$item->name ?? $item->maker_name}}</p>
      </center>
    </div>
  </div>
  <div class='container mb-3'>
    @include('item.image.color_image')
  </div>
  <div class='container'>
    @include('item.image.multi_image')
  </div>
</div>


@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="crossorigin="anonymous"></script>
<script src="{{ mix('js/ItemImage.js')}}"></script>