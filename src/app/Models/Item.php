<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use Sortable;

    public $sortable = ['cm_number','name','maker_id','category','sale_price'];
    protected $guarded = ['id'];

    public function maker()
    {
       return $this->belongsTo(Maker::class);
    }

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }
}
