@extends('layouts.base')

@section('title','メーカー一覧')

@section('headline')
<h1 class="border-bottom pb-2 mb-3"><small>メーカー一覧</small></h1>
@endsection


@section('content')
<div">
  <!--エラーメッセージ-->
  @if ($errors->any())
    <div class="alert alert-danger">
    @foreach ($errors->all() as $error)
      {{ $error }}<br>
    @endforeach
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  @endif

  <!--登録メッセージ-->
  @if (session('registered'))
    <div class="alert alert-success" role="alert">
      登録しました。
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
  @endif

  <!--更新メッセージ-->
  @if (session('my_status'))
    <div class="alert alert-success" role="alert">
      更新しました。
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
  @endif

  <div class="mb-3 clearfix">
  <!-- 新規登録ボタン -->
  <div class="clearfix">
    <a href="/admin/regist/maker" class="btn btn-success rounded-pill align-baseline align-base float-right" >
      <i class="fas fa-plus"></i> 新規登録
    </a>
  </div>
    <!-- ページネーション-->
    <div class="float-right">
  {{ $makers->appends(request()->query())->links() }}
  </div>
</div>

<table class="table table-hover">
  <thead class="text-center">
    <tr>
      <th>メーカーID</th>
      <th>メーカー名</th>
      <th>出荷日数</th>
      <th>発注先フラグ</th>
      <th class="text-center" style="width:50px;">削除</th>
    </tr>
  </thead>
  <tbody class="table-bordered table-striped">
    @foreach($makers as $maker)
    <tr class="align-middle">
      <td class="align-middle">{{$maker->id}}</td>
      <td class="align-middle">{{$maker->name}}</td>
      <td class="align-middle">{{$maker->shipping_days}}</td>
      <td class="align-middle">
        <label class="form-check-label ml-2 ">発注先</label>
        <input class="form-check-input ml-3" type="checkbox" name='supply_flag'
         value="{{old('supply_flag',$maker->supply_flag)}}"
         @if($maker->supply_flag) checked
         @else ''
        @endif
         >
      </td>
      <td class="align-middle">
        <i class="far fa-trash-alt"></i>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection