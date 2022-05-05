<div class='row'>
    <div class='sku-container container'>
      <h5>SKUS</h5>
      <div class='row'>
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm text-center">
          <thead class="thead-light">
            <tr>
              <th scope='col'>SKUコード</th>
              <th scope='col'>バーコード</th>
              <th scope='col'>サイズ</th>
              <th scope='col'>カラー</th>
              <th scope='col'>アイテムタイプ3</th>
              <th scope='col'>在庫数</th>
              <th scope='col'>在庫切れ</th>
            </tr>
          </thead>
          <tbody class='text-center'>
          @foreach($item->skus as $sku)
            <row>
              <td>
                <input type='text' name="sku[{{$sku->id}}][sku_code]" value='{{$sku->sku_code}}'  class='code-cell'>
              </td>
              <td>
                <input type='text' name="sku[{{$sku->id}}][barcode]" value='{{$sku->barcode}}'  class='code-cell'>
              </td>
              <td>
                <input type='text' name="sku[{{$sku->id}}][size]" value='{{$sku->size}}'>
              </td>
              <td>
                <input type='text' name="sku[{{$sku->id}}][color]" value='{{$sku->color}}' >
              </td>
              <td>
                <input type='text' name="sku[{{$sku->id}}][item_type3]" value='{{$sku->item_type3}}'>
              </td>
              <td>
                <input type='number' name="sku[{{$sku->id}}][stocks]" value='{{$sku->stocks}}'>
              </td>
              <td>
                <div class="custom-control custom-switch">
                <input type="hidden" name='sku[{{$sku->id}}][out_of_stock_flag]' value=0>
                  <input type="checkbox" name='sku[{{$sku->id}}][out_of_stock_flag]' class="custom-control-input" id="sku[{{$sku->id}}][outOfStockFlag]"
                  @if($sku->stocks <= 0) checked value=1 @endif
                  >
                  <label class="custom-control-label" for="sku[{{$sku->id}}][outOfStockFlag]"></label>
                </div>
              </td>
            </row>
          </tbody>
          @endforeach
        </table>
      </div>
      </div>
    </div>
  </div>