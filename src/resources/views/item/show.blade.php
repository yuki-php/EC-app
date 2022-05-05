@extends('layouts.base')

@section('title', '商品詳細')

@section('css')
<link href="{{ asset('css/item.css') }}" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}" media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}" media="screen" />
@endsection

@section('head_script')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

@endsection


@section('headline')
<h1 class="border-bottom pb-2 mb-3"><small>商品詳細</small></h1>
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

<div class='m-3 text-right'>
  <button class='button button-success'
    onclick="location.href='{{ route('item.csv-download',[$item->id]) }}'"
  >
    CSVダウンロード
  </button>
</div>
<!-- 画像 -->
<div class='image-container container'>
  @include('item.item_images')
</div>
<div class='mt-2'>
  <form action="{{route('item.update')}}" method="POST">
    @csrf
    <input type='hidden' name='item_id' value="{{$item->id}}">
    <div class='container'>
      <!-- 商品情報(テーブル) -->
      @include('item.item_table')
      <!-- SKU項目 -->
      @include('item.item_skus_table')

      <div class='text-center'>
        <input type='submit' class="btn btn-primary" value='更新'>
      </div>
    </div>
  </form>
</div>

@endsection
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous">
</script>
<script type="text/javascript" src="{{ asset('js/slick/slick.min.js') }}"></script>
<script type="text/javascript">
 jQuery(function($) {
    $('.slick-box').slick({
      infinite: true,
      slidesToShow: 5,
      slidesToScroll: 1,
      arrows:true,
    });
  });
</script>
<script>
  const itemId = @json($item->id);
  jQuery(function($){
    $('#upImage').on('click',function(){
      $('#image_file').click();
    })

    console.log(itemId);
    $('#image_file').on("change", function(e) {
      const target = $(e.currentTarget.files);
      let data = new FormData();
      Array.from(target).forEach(function(file,index) {
        console.log(file,index)
        data.append('images[' + index + '][file]', file)
      })
      console.log(data);
      $.ajax( {
      url: '/item/show/' + itemId,
      type: 'post',
      processData: false,
      contentType: false,
      data: data,
      dataType: 'json',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        alert('画像登録しました！');
        location.reload();
        console.log(data);
      },
      error: function(xhr, status, error) {
        alert(xhr.responseJSON);
        // alert('ERROR : ' + status + ' : ' + error);
      }
    });
      return false;
    });
  });
</script>