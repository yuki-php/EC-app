@extends('layouts.base')

@section('title','出品商品一覧')

@section('headline')
<h1 class="border-bottom pb-2 mb-3"><small>商品一覧</small></h1>
@endsection


@section('content')
<!--登録メッセージ-->
@if (session('registered'))
  <div class="alert alert-success" role="alert">
    登録しました。
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
  </div>
@endif

<div class="mb-3 clearfix">
  <!-- 新規登録ボタン -->
  <div class="clearfix">
    <a href="/regist_item" class="btn btn-success rounded-pill align-baseline align-base float-right" >
      <i class="fas fa-plus"></i> 新規登録
    </a>
  </div>
    <!-- ページネーション-->
    <div class="float-right">
  {{ $items->appends(request()->query())->links() }}
  </div>
</div>

<table class="table table-hover">
  <thead class="text-center">
    <tr>
      <th>商品画像</th>
      <th>@sortablelink('cm_number', '品番')</th>
      <th>@sortablelink('name', '商品名')</th>
      <th>@sortablelink('maker_id', 'メーカー')</th>
      <th>@sortablelink('category', 'カテゴリー')</th>
      <th>@sortablelink('sale_price', '販売価格')</th>
      <th class="text-center" style="width:50px;">削除</th>
    </tr>
  </thead>
  <tbody class="table-bordered table-striped">
    @foreach($items as $item)
    <tr class="align-middle">
      <td class="align-middle" style="width:90px;">
        <a href="{{ url('/item/show',$item->id)}}">
          @if($item->thumbnail)
            <img src="{{$item->thumbnail->url}}"
              height="70px"
              class="d-block mx-auto" 
            />
          @else
            <img src="{{ asset('storage/icon/no_image.png') }}"
              height="70px"
              class="d-block mx-auto" 
            />
          @endif
          </picture>
        </a>
      </td>
      <td class="align-middle">
        <a href="{{ url('/item/show',$item->id)}}">
          {{$item->cm_number}}
        </a>
      </td>
      <td class="align-middle">{{$item->name}}</td>
      <td class="align-middle">{{$item->maker->name}}</td>
      <td class="align-middle">{{$item->category}}</td>
      <td class="align-middle">{{$item->sale_price}}</td>
      <td class="align-middle">
        <i class="far fa-trash-alt"></i>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection