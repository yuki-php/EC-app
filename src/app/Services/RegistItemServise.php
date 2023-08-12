<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use App\Models\Sku;
use App\Models\Item;
use App\Models\Maker;
use App\Models\SelectCode;

class RegistItemServise
{
  public function __construct()
  {

  }

  /**
   * 新規商品登録
   * 
   * @param Collection
   */
  public function createNewItem(array $attributes): bool
  {
    $attributes['cm_number'] = 'CM-' . sprintf('%02d', $attributes['maker_id']) . $attributes['maker_code'];
    $attributes['supplier_id'] = $attributes['supplier_id'] ?? $attributes['maker_id'];
    DB::beginTransaction();
    try {
      $newItem = Item::create($attributes);
      $types = $attributes['types'];
        if($types['maker_type1']['name'] !== null) {
        $t1Count = 1;
          foreach($types['maker_type1'] as $key1 => $value1) {
          if ($key1 === 'name') continue;
          if ($value1 === null) break;

          if ($types['maker_type2']['name'] !== null) {
            $t2Count = 1;
            foreach ($types['maker_type2'] as $key2 => $value2) {
              if ($key2 === 'name') continue;
              if ($value2 === null) break;

              if ($types['maker_type3']['name'] !== null) {
                $t3Count = 1;
                foreach ($types['maker_type3'] as $key3 => $value3) {
                  if ($key3 === 'name') {
                    $item3Name = $value3;
                    continue;
                  }
                  if ($value3 === null) break;
                  $skuCode = $newItem->cm_number . sprintf('%02d', $t1Count) . sprintf('%02d', $t2Count) . sprintf('%02d', $t3Count);
                  $newItem->skus()->create([
                    'maker_size' => $value1,
                    'size' => $value1,
                    'size_code' => SelectCode::firstWhere('original_code', $value1)->sku_code ?? '',
                    'size_display_order' => $t1Count,
                    'maker_color' => $value2,
                    'color' => $value2,
                    'color_code' => SelectCode::firstWhere('original_code', $value2)->sku_code ?? '',
                    'color_display_order' => $t2Count,
                    'maker_type3_name' => $item3Name,
                    'item_type3_name' => $item3Name,
                    'maker_type3' => $value3,
                    'item_type3' => $value3,
                    'type3_display_order' => $value3,
                    'sku_code' =>  $skuCode,
                    'barcode' => $skuCode
                  ]);
                  $t3Count++;
                }
              } else {
                $skuCode = $newItem->cm_number . sprintf('%02d', $t1Count) . sprintf('%04d', $t2Count);
                $newItem->skus()->create([
                  'maker_size' => $value1,
                  'size' => $value1,
                  'size_code' => SelectCode::firstWhere('original_code', $value1)->sku_code ?? '',
                  'size_display_order' => $t1Count,
                  'maker_color' => $value2,
                  'color' => $value2,
                  'color_code' => SelectCode::firstWhere('original_code', $value2)->sku_code ?? '',
                  'color_display_order' => $t2Count,
                  'sku_code' =>  $skuCode,
                  'barcode' => $skuCode
                ]);
              }
              $t2Count++;
            }
          } else {
            $skuCode = $newItem->cm_number . sprintf('%06d', $t1Count);
            $newItem->skus()->create([
              'maker_size' => $value1,
              'size' => $value1,
              'size_code' => SelectCode::firstWhere('original_code', $value1)->sku_code ?? '',
              'size_display_order' => $t1Count,
              'sku_code' =>  $skuCode,
              'barcode' => $skuCode
            ]);
          }
          $t1Count++;
          }
        }
        DB::commit();
    } catch(\Exception $e){
        DB::rollback();
        dd($e);
      return false;
    }
    return true;
  }

  private function registNewSku()
  {

  }
}