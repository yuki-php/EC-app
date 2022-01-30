<!-- 親テンプレート -->
@extends('layouts.base')
 
@section('title', '商品新規登録')


@section('headline')
<h1 class="border-bottom pb-2 mb-3"><small>商品新規登録</small></h1>
@endsection

@section('content')

<!--一括登録テーブル-->
<div class="item-detail-table">
  <form action="/regist_item"  method="POST" class="mb-5" name="form"> 
  @csrf
    <!--基本情報-->
    <div id="itemDetailForm">
      <h6>基本情報</h6>
      <table class="table table-bordered p-3">
        <tbody>
          <tr>
            <th  class="th-row" scope="row" >メーカー</th>
            <td>
              <select name="maker" class="custom-select custom-select-sm w-25">
              @foreach($makers as $maker)
                <option value="{{old('maker',$maker->id)}}">
                {{$maker->name}}
                </option>
              @endforeach
              </select>
            </td>
          </tr>

          <tr>
            <th  class="th-row" scope="row">メーカー品番<span style="color:red;">*</span></th>
            <td>
              <div class="form-group needs-validation mb-0">
                <input type="text" name="maker_code" value="{{ old('maker_code') }}" class="form-control form-control-sm w-50 @if(!empty($errors->first('maker_code'))) is-invalid @endif" required>

                <div class="invalid-feedback">
                  {{ $errors->first('maker_code') }}
                </div>
              </div>
            </td>
          </tr>

          <tr>
            <th  class="th-row" scope="row">メーカー商品名</th>
            <td>
              <input type="text" name="maker_name" value="{{ old('maker_name') }}" class="form-control form-control-sm w-75">
            </td>
          </tr>

          <tr>
            <th  class="th-row" scope="row">下代</th>
            <td>
              <input type="text" name="wholesale_price" value="{{ old('wholesale_price') }}" class="form-control form-control-sm w-50 @if(!empty($errors->first('wholesale_price'))) is-invalid @endif">

              <div class="invalid-feedback">
              {{ $errors->first('wholesale_price') }}
              </div>
            </td>
          </tr>

          <tr>
            <th  class="th-row" scope="row">販売価格</th>
            <td>
              <input type="text" name="sale_price" value="{{ old('sale_price') }}" class="form-control form-control-sm w-50 @if(!empty($errors->first('sale_price'))) is-invalid @endif">
              <div class="invalid-feedback">
              {{ $errors->first('sale_price') }}
              </div>
            </td>
          </tr>

          <tr>
            <th  class="th-row" scope="row">製造国</th>
            <td>
              <input type="text" name="country_of_origin" value="{{ old('country_of_origin') }}" class="form-control form-control-sm w-50">
            </td>
          </tr>

          <tr>
            <th  class="th-row" scope="row">素材</th>
            <td>
              <textarea class="form-control" name="material" rows="2" style="font-size:13px;">{{ old('material') }}</textarea>
            </td>
          </tr>

          <tr>
            <th  class="th-row" scope="row">性別</th>
            <td>
              <select name="sex" class="custom-select custom-select-sm w-25">
                <option value='フリー' @if( old('sex') === 'フリー' ) selected @endif>フリー
                </option>
                <option value='メンズ' @if( old('sex') === 'メンズ'  ) selected @endif>メンズ
                </option>
                <option value='レディース'  @if( old('sex') === 'レディース' ) selected @endif>レディース
                </option>
                <option value='キッズ'  @if( old('sex') === 'キッズ' ) selected @endif>キッズ
                </option>
              </select>
            </td>
          </tr>

          <tr>
            <th  class="th-row" scope="row">説明文</th>
            <td>
              <textarea class="form-control" name="description" rows="10" style="font-size:13px;">{{ old('description') }}</textarea>
            </td>
          </tr>

          <tr>
            <th  class="th-row" scope="row">備考</th>
            <td>
              <textarea class="form-control" name="remarks" rows="10" style="font-size:13px;">{{ old('remarks') }}</textarea>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!--商品タイプ-->
    <div  class="container type-container m-0 p-0">
      <div class="row">
        @for($tCount = 1; $tCount <=3; $tCount++)
        <div class="col-4">
          <table class="type{{$tCount}}_table table table-bordered text-center mb-1">
            <thead class="table-active">
              <tr>
                <th scope="col">タイプ{{$tCount}}</th>
                <th scope="col">
                  <input type='text' name="types[maker_type{{$tCount}}]['name']" class="form-control form-control-sm  w-100" value="{{old('item_type$tCount')}}">
                </th>
              </tr>
            </thead>
            <tbody id ="type{{$tCount}}_table">
              @for ($i = 1; $i <= 10; $i++)
              <tr id="type{{$tCount}}_row{{$i}}" class="@if($i > 5) type{{$tCount}}_over d-none @endif">
                <th  class="th-row" scope="row">{{$i}}</th>
                <td>
                  <input type="text" name="types[maker_type{{$tCount}}][type{{$tCount}}_{{$i}}]" value="{{ old('type$tCount_$i.0') }}" class="form-control form-control-sm w-100 @if(!empty($errors->first('type{{$tCount}}_{{$i}}.0'))) is-invalid @endif">
                  <div class="invalid-feedback">
                    {{ $errors->first('type$tCount*') }}
                  </div>
                </td>
              </tr>
              @endfor
            </tbody>
          </table>

          <button id="type{{$tCount}}" type="button" class="btn btn-outline-secondary btn-sm" style="display: inline-block; cursor: pointer;" onclick="openBundle(this)">  
            <span>  
            6行目以降を表示する  
            </span>  
          </button> 
        </div>
        @endfor
      </div>
    </div>

    <div class="text-center">
      <input type="submit" class="btn btn-primary btn-sm submit-btn" value="作成">
    </div>

  </form>
</div>

@endsection



@section('foot_script')
<script>
//一括変更行表示・非表示
function openBundle(tar_btn){

  let typeNum = tar_btn.id;
  let table = document.getElementById(typeNum + '_table');
  let target = document.getElementsByClassName(typeNum + '_over');
  if(table.getElementsByClassName('d-none').length > 0) {
    for(let i = 0; i <= target.length-1; i++) {
      target[i].classList.remove('d-none');
      tar_btn.innerHTML = '6行目以降を非表示する ';
    }
  } else {
    for(let i = 0; i <= target.length-1; i++) {
      target[i].classList.add('d-none');
      tar_btn.innerHTML = '6行目以降を表示する ';
    }
  }
}
</script>
@endsection