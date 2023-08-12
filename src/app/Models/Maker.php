<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maker extends Model
{
    protected $guarded = ['id'];

    const SHIPPING_DATE = [
        1 => '1 ~ 2日',
        2 => '2 ~ 3日',
        3 => '3 ~ 4日',
        4 => '4 ~ 5日',
        5 => '7日以内'
    ];

    /**
     * 出荷日数
     */
    public function getShippingDaysAttribute()
    {
        return self::SHIPPING_DATE[$this->shipping_date];
    }
}
