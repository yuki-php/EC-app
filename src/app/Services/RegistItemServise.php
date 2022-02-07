<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use App\Models\Sku;
use App\Models\Item;
use App\Models\Maker;

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
  public function createNewItem(array $attributes):array
  {
    DB::beginTransaction();
    try {
      $newItem = Item::create($attributes);
      $types = $attributes['types'];
        if($types['maker_type1']['name'] !== null) {
          foreach($types['maker_type1'] as $key1 => $value1) {
              if($key1 === 'name') continue;
              if($value1 === null) break;

              if($types['maker_type2']['name'] !== null) {
                foreach($types['maker_type2'] as $key2 => $value2) {
                  if($key2 === 'name') continue;
                  if($value2 === null) break;

                  if($types['maker_type3']['name'] !== null) {
                    foreach($types['maker_type3'] as $key3 => $value3) {
                      if($key3 === 'name') continue;
                      if($value3 === null) break;
                      $newItem->skus()->create([
                          'maker_color' => $value1,
                          'maker_size' => $value2,
                          'maker_type1' => $value3
                      ]);
                    }
                  } else {
                    $newItem->skus()->create([
                      'maker_color' => $value1,
                      'maker_size' => $value2,
                      'maker_type1' => ''
                    ]);
                  }
                }
              }
          }
        }
        DB::commit();
    } catch(\Exception $e){
        DB::rollback();
        dd($e);
        return ['message' => false];
    }
    return ['message' => true];
  }

  private function registNewSku()
  {

  }
}