<?php

namespace App\Services\MallListing;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class YahooCsvService
{
  const YAHOO_PRODUCT_HEADER = [
    'path',
    'name',
    'code',
    'price',
    'headline',
    'explanation',
    'additional1',
    'additional2',
    'additional3',
  ];

  const YAHOO_OPTION_HEADER = [
    'code',
    'sub-code',
    'option-name-1',
    'option-value-1',
    'unselectable-1',
    'spec-id-1',
    'spec-value-id-1',
    'option-name-2',
    'option-value-2',
    'spec-id-2',
    'spec-value-id-2',
    'lead-time-instock',
    'sub-code-img1',
  ];

  public function Listing(Collection $items)
  {
    $bulk = ($items->count() > 1) ?  true : false;

    Storage::disk('local')->makeDirectory("/public/ProductCsv/Yahoo");
    $this->getProductCsv($items, $bulk);
    $this->getOptionCsv($items, $bulk);
  }

  public function getProductCsv(Collection $items, bool $bulk)
  {
    if ($bulk) {
      $createCsvFile = fopen(storage_path("app/public/ProductCsv/Yahoo/product.csv"), 'w');
    } else {
      $fileName = $items->first()->cm_number;
      $createCsvFile = fopen(storage_path("app/public/ProductCsv/Yahoo/$fileName.csv"), 'w');
    }

    $headerColumn = self::YAHOO_PRODUCT_HEADER;

    mb_convert_variables('SJIS-win', 'UTF-8', $headerColumn); //文字化け対策
    // ヘッダー行
    fputcsv($createCsvFile, $headerColumn);

    foreach ($items as $item) {

      $path = '';
      if ($item->category_path) {
        foreach ($item->category_path as $key => $value) {
          if ($key !== 0) $value = ":$value";
          $path .= $value;
        }
      }

      $row = [
        $path,
        $item->name,
        $item->cm_number,
        $item->sale_price,
        $item->head_name,
        $item->description,
        $item->remarks,
        '',
        '',
      ];
      mb_convert_variables('SJIS-win', 'UTF-8', $row); //文字化け対策

      fputcsv($createCsvFile, $row);
    }

    fclose($createCsvFile);
  }

  public function getOptionCsv(Collection $items, bool $bulk)
  {
    if ($bulk) {
      $createCsvFile = fopen(storage_path("app/public/ProductCsv/Yahoo/option.csv"), 'w');
    } else {
      $fileName = $items->first()->cm_number . '_option';
      $createCsvFile = fopen(storage_path("app/public/ProductCsv/Yahoo/$fileName.csv"), 'w');
    }

    $headerColumn = self::YAHOO_OPTION_HEADER;
    mb_convert_variables('SJIS-win', 'UTF-8', $headerColumn); //文字化け対策
    // ヘッダー行
    fputcsv($createCsvFile, $headerColumn);

    foreach ($items as $item) {

      foreach ($item->skus as $sku) {
        $row = [
          $item->cm_number,
          $sku->sku_code,
          'カラー',
          $sku->color,
          0,
          '',
          '',
          'サイズ',
          $sku->size,
          '',
          '',
          2,
          ''
        ];
        mb_convert_variables('SJIS-win', 'UTF-8', $row); //文字化け対策
        fputcsv($createCsvFile, $row);
      }
    }
    fclose($createCsvFile);
  }
}
