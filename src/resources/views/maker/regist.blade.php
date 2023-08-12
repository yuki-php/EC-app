<!-- 親テンプレート -->
@extends('layouts.base')
 
@section('title', 'メーカー新規登録')


@section('headline')
<h1 class="border-bottom pb-2 mb-3"><small>メーカー新規登録</small></h1>
@endsection

@section('content')

<!--一括登録テーブル-->
<div class="item-detail-table w-75 mx-auto">
  <form action='/admin/regist/maker' method="POST" class="mb-5"> 
  @csrf
    <!--基本情報-->
    <div >
      <h6>メーカー情報</h6>
      <table class="table table-bordered p-3">
        <tbody>
          <tr>
            <th  class="th-row" scope="row">メーカー名</th>
            <td>
              <input type='text' class="form-control" name="name" rows="2" style="font-size:13px;" value="{{ old('name') }}">
            </td>
          </tr>

          <tr>
            <th  class="th-row" scope="row">メーカー名(カナ)</th>
            <td>
            <input type='text' class="form-control" name="name_kana" rows="2" style="font-size:13px;" value="{{ old('name-kana') }}">
            </td>
          </tr>

          <tr>
            <th  class="th-row" scope="row">出荷日数</th>
            <td>
              <select name="shipping_date" class="custom-select custom-select w-25">
                <option value='' @if( old('shipping_date') === '' ) selected @endif></option>
                @foreach($shippingDays as $key => $date)
                <option value="{{$key}}" @if( old('shipping_date') ===  $date ) selected @endif>{{$date}}
                </option>
                @endforeach
              </select>
            </td>
          </tr>

          <tr>
            <th  class="th-row" scope="row">発注先フラグ</th>
            <td>
              <div class="custom-control custom-checkbox mr-3 custom-control-inline mt-2">
                <input type="hidden" name="supply_flag" value="0">
                <input type="checkbox" name="supply_flag" id="発注先フラグ" class="form-check-input" value="1" @if(old('supply_flag') === 0 ) @endif>
                <label for="発注先フラグ"  class='form-check-label ml-3'>発注先</label>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="text-center">
      <input type="submit" class="btn btn-primary btn-sm submit-btn" value="作成">
    </div>

  </form>
</div>

@endsection