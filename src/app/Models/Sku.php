<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    protected $guarded = ['id'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function getColorImages()
    {
        return $this->hasMany(colorImage::class, 'item_id', 'item_id')
        ->where('color', $this->color_code);
    }
}
