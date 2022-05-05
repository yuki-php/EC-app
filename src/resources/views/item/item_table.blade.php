<div class='row'>
  <div class='item-container container'>
    <h5>商品情報</h5>
    <div class='row'>
      <table class='table table-hover table-bordered table-sm text-center form-group-sm'>
        <thead  class="thead-light">
          <th scope='col' style='width: 20%;'></th>
          <th scope='col' style='width: 50%;'>オリジナル</th>
          <th scope='col' style='width: 30%;'>メーカー情報</th>
        </thead>
        <tr>
          <th scope="row">商品番号</th>
          <td>
            <div class='form-area needs-validation' contentEditable='true' >
              <input type='text' name='cm_number' value="{{old('cm_number',$item->cm_number)}}" class='form-control form-control-sm' required>
            </div>
          </td>
          <td>
            <div class='form-area2'>
              <input type='text' name='maker_code' value="{{$item->maker_code}}" class='form-control form-control-sm '>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row" class='align-middle'>商品名</th>
          <td>
            <div class='form-area needs-validation'>
              <input type='text' name='name' value="{{old('item_name',$item->name)}}" class='form-control form-control-sm'  required>
            </div>
          </td>
          <td>
            <div class='form-area2'>
              <input type='text' name='maker_item_name' value="{{$item->maker_item_name}}" class='form-control form-control-sm'>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row" class='align-middle'>販売価格/下代</th>
          <td>
            <div class='form-area needs-validation m-0'>
              <input type='number' name='sale_price' value="{{old('sale_price',$item->sale_price)}}" class='form-control form-control-sm'  required>
            </div>
          </td>
          <td>
            <div class='form-area2'>
              <input type='text' name='wholesale_price' value="{{$item->wholesale_price}}" class='form-control form-control-sm'>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row" class='align-middle'>メーカー名</th>
          <td>
            <div class='form-area needs-validation m-0'>
              <select name='maker_id' class="custom-select custom-select-sm">
                <option value=""></option>
                @foreach($makers as $maker)
                <option value="{{$maker->id}}"
                  @if(old('maker_id',$item->maker_id) === $maker->id) selected @endif
                >{{$maker->name}}</option>
                @endforeach
              </select>
            </div>
          </td>
          <td>
            <div class='form-area2'>
              <input type='text' name='maker_name' value="{{$item->maker->name}}" class='form-control form-control-sm '>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row" class='align-middle'>発注先</th>
          <td>
            <div class='form-area needs-validation m-0'>
              <select name='supplier_id' class="custom-select custom-select-sm">
                <option value=""></option>
                @foreach($makers as $maker)
                <option value="{{$maker->id}}"
                  @if(old('supplier_id',$item->supplier_id) === $maker->id) selected @endif
                >{{$maker->name}}</option>
                @endforeach
              </select>
            </div>
          </td>
          <td>
            <div class='form-area2'>
              <input type='text' name='supplier_name' value="{{$item->supplier->name}}" class='form-control form-control-sm '>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row" class='align-middle'>生産国</th>
          <td>
            <div class='form-area needs-validation m-0'>
              <input type='text' name='country_of_origin' value="{{old('country_of_origin',$item->country_of_origin)}}" class='form-control form-control-sm' required>
            </div>
          </td>
          <td>
            <div class='form-area2'>
              <p>{{$item->country_of_origin}}</p>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row" class='align-middle'>素材</th>
          <td>
            <div class='form-area needs-validation m-0'>
              <input type='text' name='material' value="{{old('material',$item->material)}}" class='form-control form-control-sm '>
            </div>
          </td>
          <td>
            <div class='form-area2'>
              <input type='text' name='maker_material' value="{{old('maker_material',$item->material)}}" class='form-control form-control-sm'>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row" class='align-middle'>性別</th>
          <td>
            <div class='form-area needs-validation m-0'>
              <select name='sex' class="custom-select custom-select-sm">
                <option value=''></option>
                <option value='フリー' @if(old('sex',$item->sex) === 'フリー') selected @endif>フリー</option>
                <option value='メンズ' @if(old('sex',$item->sex) === 'メンズ') selected @endif>メンズ</option>
                <option value='レディース' @if(old('sex',$item->sex) === 'レディース') selected @endif>レディース</option>
                <option value='キッズ'@if(old('sex',$item->sex) === 'キッズ') selected @endif>キッズ</option>
              </select>
            </div>
          </td>
          <td>
            <div class='form-area2'>
              <input type='text' name='maker_sex' value="{{$item->sex}}" class='form-control form-control-sm'>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row" class='align-middle'>出荷形状</th>
          <td>
            <div class='form-area needs-validation m-0'>
              <select name="packing_shape" class="custom-select custom-select-sm">
                <option value='' @if( old('packing_shape') === '' ) selected @endif></option>
                @foreach($packShape as $key => $value)
                <option value="{{$key}}" @if( old('packing_shape') ===  $key ) selected @endif>{{$value}}
                </option>
                @endforeach
              </select>
            </div>
          </td>
          <td>
            <div class='form-area2'>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row" class='align-middle'>梱包サイズ</th>
          <td>
            <div class='form-area'>
              <input type='text' name='pack_size' value="{{old('pack_size',$item->pack_size)}}" class='form-control form-control-sm'>
            </div>
          </td>
          <td>
            <div class='form-area2'>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row" class='align-middle'>送料込みフラグ</th>
          <td>
            <div class="form-group  m-0">
            <div class='container'>
              <div class='row'>
                  <div class="col-6 form-check p-0">
                    <input type="radio" name="postage_flag" id="送料込み" value=1  @if(old('postage_flag',$item->postage_flag) === 1) checked @endif>
                      <label for=1 class='form-check-label'>送料込み</label>
                  </div>
                  <div class="col-6 form-check p-0">
                    <input type="radio" name="postage_flag" id="送料込み" value=0 @if(old('postage_flag',$item->postage_flag) === 0 || old('postage_flag',$item->postage_flag) === null) checked @endif>
                    <label for=0  class='form-check-label'>送料別</label>
                  </div>
                </div>
              </div>
            </div>
          </td>
          <td>
            <div class='form-area2'>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row" class='align-middle'>下限数量</th>
          <td>
            <div class='form-area needs-validation m-0'>
              <input type='number' name='limit_stock' value="{{old('limit_stock',$item->limit_stock)}}" class='form-control form-control-sm'>
            </div>
          </td>
          <td>
            <div class='form-area2'>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row" class='align-middle'>ヘッドネーム</th>
          <td>
            <div class='form-area needs-validation m-0'>
              <input type='text' name='head_name' value="{{old('head_name',$item->head_name)}}" class='form-control form-control-sm '>
            </div>
          </td>
          <td>
            <div class='form-area2'>
              <input type='text' name='maker_head_name' value="{{old('maker_head_name',$item->maker_item_name)}}" class='form-control form-control-sm '>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row" class='align-middle'>商品説明</th>
          <td>
            <div class='form-area needs-validation m-0'>
              <textarea type='text' name='description' class='form-control form-control-sm '>{{old('description',$item->description)}}</textarea>
            </div>
          </td>
          <td>
            <div class='form-area2'>
              <textarea type='text' name='maker_descriptionr' class='form-control form-control-sm'>{{old('maker_description',$item->maker_description)}}</textarea>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row" class='align-middle'>備考</th>
          <td>
            <div class='form-area needs-validation m-0'>
              <textarea name='remarks' class='form-control form-control-sm'>{{old('remarks',$item->remarks)}}</textarea>
            </div>
          </td>
          <td>
            <div class='form-area2'>
              <textarea name='remarks' value="{{old('remarks',$item->remarks)}}" class='form-control form-control-sm'>{{old('remarks',$item->remarks)}}</textarea>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row" class='align-middle'>お届け日数/メーカー納期</th>
          <td>
            <div class='form-area needs-validation m-0'>
              <input type='number' name='delivery_date' value="{{old('delivery_date',$item->delivery_dayte)}}" class='form-control form-control-sm '>
            </div>
          </td>
          <td>
            <div class='form-area2'>
              <input type='number' name='maker_shipping_date' value="{{old('maker_shipping_date',$item->maker->shipping_date)}}" class='form-control form-control-sm'>
            </div>
          </td>
        </tr>
        <tr>
          <th scope="row" class='align-middle'>カテゴリー</th>
          <td>
            @for($i = 1; $i <= 5; $i++)
            <div class='form-area needs-validation mt-1 mb-1'>
              <input type='text' name="category_{{$i}}" 
              value="{{ old("category_$i",($item->categories)? "$item->categories->category_$i": "" ) }}" 
              placeholder="カテゴリー{{$i}}"
              class='form-control form-control-sm'>
            </div>
            @endfor
          </td>
        </tr>
        <tr>
          <th scope="row" class='align-middle'>出品済み/販売停止フラグ</th>
          <td>
            <div>
              <div class='container'>
                <div class='row'>
                  <div class="col-6 form-check form-switch p-0">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label ml-2" >出品</label>
                  </div>
                  <div class="col-6 form-check form-switch p-0">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label ml-2">販売停止</label>
                  </div>
                </div>
              </div>
            </div>
          </td>
          <td></td>
        </tr>
      </table>
    </div>
  </div>
</div>