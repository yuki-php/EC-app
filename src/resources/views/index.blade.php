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
@elseif (session('error'))
  <div class="alert alert-danger" role="alert">
    {{ session('error') }}
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
    <button  type="button" class="btn btn-primary btn-circle btn-small" data-toggle="modal" data-target="#myModal1">
      <i class="far fa-file-excel"></i>一括ダウンロード
    </button>
    <!-- モーダル -->
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">CSVダウンロード</h4>
          </div>
          <form id='csv_download_link' action="" method="post">
          @csrf
          <div class="modal-body">
            <p class="font-weight-bold">モール</p>
            <div class="form-group">
              <div class="form-check">
                <input class="downloadMalls form-check-input" type="checkbox" id="Yahoo" name="mallIds[]" value="Yahoo">
                <label class="form-check-label  ml-3" for="check1a">Yahooショッピング</label>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Download</button>
          </form>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- ページネーション-->
  <div class="float-right">
    {{ $items->appends(request()->query())->links() }}
  </div>
</div>

<table class="table table-hover">
  <thead class="text-center">
    <tr>
      <th style="width: 50px;">
        <div style="cursor:pointer;">
          <span class="bundle-icon">
            <i class="fas fa-caret-right"></i>
            一括
          </span>
        </div>
        <div class="bundle mt-3 d-none">
          <input type="checkbox" name="bundle-check" class="m-auto">
        </div>
      </th>
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
    <tr class="align-middle text-center">
      <td class="align-middle">
        <input class="selectIds" type="checkbox" name="bulks[$item->id]" value="{{$item->id}}">
      </td>
      <td class="align-middle" style="width:90px;">
        <a href="{{ url('/item/show',$item->id)}}">
          @if($item->thumbnail)
            <img src="{{$item->thumbnail_for_blade}}"
              height="70px"
              class="d-block mx-auto"
            />
          @else
            <img src="{{asset('storage/icon/no_image.png')}}"
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  const baseUrl = '/item/csv-download/'
  jQuery(function() {
    $('#csv_download_link').attr('action',baseUrl);

    $('.selectIds').change(function() {
      $('#csv_download_link').attr('action',baseUrl);
      let param = {};
      let ids = [];
      $('.selectIds:checked').each(function() {
        ids.push($(this).val());
      });
      param.itemId = ids;
      let setUrl = baseUrl + '/?' +  $.param(param);
      $('#csv_download_link').attr('action',setUrl);
    })

  $('.bundle-icon').on('click',function() {
    const bundleTarget = $('.bundle'); 
    if(bundleTarget.hasClass('d-none')) {
      bundleTarget.removeClass('d-none').addClass('d-block');
      $('.bundle-icon i').removeClass('fa-caret-right').addClass('fa-caret-down');
    } else {
      bundleTarget.removeClass('d-block').addClass('d-none');
       $('.bundle-icon i').removeClass('fa-caret-down').addClass('fa-caret-right');
    }
  })

  $('input[name=bundle-check]').change(function() {
    let res = $(this).prop('checked');
    let param = {};
    let ids = [];
    if(res) {
      $('.selectIds').each(function() {
        $(this).prop('checked',res);
        ids.push($(this).val());
      })
      param.itemId = ids;
      let setUrl = baseUrl + '/?' +  $.param(param);
      $('#csv_download_link').attr('action',setUrl);
    } else {
      $('.selectIds').each(function() {
        $(this).prop('checked',res);
        ids.push($(this).val());
      })
      $('#csv_download_link').attr('action',baseUrl);
    }
    
  })
});
</script>