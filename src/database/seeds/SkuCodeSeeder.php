<?php

use Illuminate\Database\Seeder;

use App\Models\SelectCode;

class SkuCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            [
                'original_code' => 'ホワイト',
                'sku_code' => 'white'
            ],
            [
                'original_code' => 'ブラック',
                'sku_code' => 'black'
            ],
            [
                'original_code' => 'レッド',
                'sku_code' => 'red'
            ],
            [
                'original_code' => 'ブルー',
                'sku_code' => 'blue'
            ],
            [
                'original_code' => 'グリーン',
                'sku_code' => 'green'
            ],
            [
                'original_code' => 'イエロー',
                'sku_code' => 'yellow'
            ],
            [
                'original_code' => 'グレー',
                'sku_code' => 'gray'
            ],
            [
                'original_code' => 'ピンク',
                'sku_code' => 'pink'
            ],
            [
                'original_code' => 'ベージュ',
                'sku_code' => 'beige'
            ],
            [
                'original_code' => 'パープル',
                'sku_code' => 'purple'
            ],
            [
                'original_code' => 'グレージュ',
                'sku_code' => 'greige'
            ],
            [
                'original_code' => 'ブラウン',
                'sku_code' => 'brown'
            ],
            [
                'original_code' => 'シルバー',
                'sku_code' => 'silver'
            ],
            [
                'original_code' => 'ダークブラウン',
                'sku_code' => 'darkbrown'
            ],
            [
                'original_code' => 'ナチュラル',
                'sku_code' => 'natural'
            ],
            [
                'original_code' => 'ネイビー',
                'sku_code' => 'navy'
            ],
            [
                'original_code' => 'オリーブ',
                'sku_code' => 'olive'
            ],
            [
                'original_code' => 'ライトブルー',
                'sku_code' => 'lightblue'
            ],
            [
                'original_code' => 'カーキ',
                'sku_code' => 'khaki'
            ],
            [
                'original_code' => 'ナチュラル',
                'sku_code' => 'natural'
            ],
            [
                'original_code' => 'ピンクベージュ',
                'sku_code' => 'pinkbeige'
            ],
            [
                'original_code' => 'ラベンダー',
                'sku_code' => 'lavender'
            ],
            [
                'original_code' => 'モカブラウン',
                'sku_code' => 'mocabrown'
            ],
            [
                'original_code' => 'ダークグレー',
                'sku_code' => 'darkgray'
            ],
            [
                'original_code' => 'チャコール',
                'sku_code' => 'charcoal'
            ],
            [
                'original_code' => 'ウォルナット',
                'sku_code' => 'walnut'
            ],
            [
                'original_code' => 'オレンジ',
                'sku_code' => 'orange'
            ],
            [
                'original_code' => 'フリー',
                'sku_code' => 'free'
            ],
        ];

        foreach ($params as $param) {
            SelectCode::updateOrCreate($param);
        }
    }
}
