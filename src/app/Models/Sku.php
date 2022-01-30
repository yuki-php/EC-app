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
}
