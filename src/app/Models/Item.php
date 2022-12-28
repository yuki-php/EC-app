<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use Sortable;

    public $sortable = ['cm_number','name','maker_id','category','sale_price'];
    protected $guarded = ['id'];

    const SEX = [
        1 => 'フリー',
        2 => 'メンズ',
        3 => 'レディース',
        4 => 'キッズ'
    ];

    const PACKING_SHAPE = [
        1 => 'メール便',
        2 => '宅配便',
    ];

    public function maker()
    {
       return $this->belongsTo(Maker::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Maker::class, 'supplier_id');
    }

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function color_images()
    {
        return $this->hasMany(colorImage::class);
    }

    public function categories()
    {
        return $this->hasOne(category::class);
    }

    public function getThumbnailAttribute()
    {
        $image = $this->images->first();
        if (empty($image)) {
            return null;
        }
        return $image->file_path;
        // return \Storage::disk('HDD')->url($image->file_path);
    }

    public function getThumbnailForBladeAttribute()
    {
        $image = $this->images->first();
        if (empty($image)) {
            return null;
        }
        $img = file_get_contents(\Storage::disk('HDD')->path($image->file_path));
        $enc_img = base64_encode($img);
        $imginfo = getimagesize('data:application/octet-stream;base64,' . $enc_img);

        return "data:$imginfo[mime];base64,$enc_img";
    }

    public function getCategoryPathAttribute(): ?array
    {
        $category = $this->categories;
        if (!$category) return null;

        $array = [];
        for ($i = 1; $i <= 5; $i++) {
            if ($data = $category->{"category_{$i}"}) {
                $array[] = $data;
            }
        }
        return $array;
    }
}
