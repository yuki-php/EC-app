<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
class Image extends Model
{
    protected $guarded = ['id'];

    public function  getUrlAttribute(): ?string
    {
        if (empty($this->file_path)) {
            return null;
        }

        return Storage::disk('local')->url($this->file_path);
    }

    public function getImageForBladeAttribute()
    {
        $img = file_get_contents(\Storage::disk('HDD')->path($this->file_path));
        $enc_img = base64_encode($img);
        $imginfo = getimagesize('data:application/octet-stream;base64,' . $enc_img);

        return "data:$imginfo[mime];base64,$enc_img";
    }
}
