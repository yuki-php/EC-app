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

<!--検索フォーム-->
<div class="card  bg-light mb-3">
  <div class="card-body">
    <form action="{{url('/item')}}" method="get">
      @csrf

      <div class="row mb-3">
        <div class="col-sm-6 col-md-6 col-lg-4">
          <p class="mb-1" style="margin-top:2px;">キーワード</p>
          <input id="" name="keyword" class="form-control form-control-sm mb-2" type="text" value="{{ $pagination_params['keyword'] }}" maxlength="20">

          <p class="mb-1">検索対象：

          <div class="custom-control custom-radio custom-control-inline">
            <input id="search_target1" name="search_target" class="custom-control-input" type="radio" value="cm_number" checked="checked">
            <label for="search_target1" class="custom-control-label">
            品番
            </label>
          </div>

          <div class="custom-control custom-radio custom-control-inline">
            <input id="search_target2" name="search_target" class="custom-control-input" type="radio" value="item_name"  {{ $pagination_params['search_target'] == 'maker_item_name' ? 'checked' : '' }}>
            <label for="search_target2" class="custom-control-label">
            商品名
            </label>
          </div>

          </p>
        </div>

        <div class="col-sm-2 col-md-2 col-lg-2">
        <p class="mb-1">メーカー</p>
          <select name="search_maker_id" class="custom-select custom-select-sm w-100">
            <option value="">全て</option>
            @foreach($makers as $maker)
            <option value="{{ $maker->id }}" {{ $pagination_params['search_maker_id'] == $maker->id ? 'selected' : '' }}>
              {{ $maker->name }}
            </option>
            @endforeach
          </select>
        </div>

      </div>

      <div class="text-center">
      <input type="submit" class="btn btn-primary btn-sm submit-btn mx-1" value="検索" style="width:200px;">
      </div>

    </form>
  </div>
</div>

<div class="mb-3 clearfix">
  <!-- 新規登録ボタン -->
  <div class="float-right">
    <a href="/regist_item" class="btn btn-success rounded-pill align-baseline align-base float-right" >
      <i class="fas fa-plus"></i> 新規登録
    </a>
  </div>
  <div class="float-right mr-3">
    <a href="{{route('item.csv-download',['itemId' => $items->pluck('id')->implode(',')])}}" >
    <!-- <a href="/item/csv-download/{{$items->pluck('id')}}" > -->
      <button  type="button" class="btn btn-primary btn-circle btn-small ">
        <i class="far fa-file-excel"></i>一括ダウンロード
      </button>
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
            <!-- <img src="{{ asset('storage/icon/no_image.png') }}" -->
            <img href="/Volumes/HDD/test/lack/3329097_7.jpg"
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