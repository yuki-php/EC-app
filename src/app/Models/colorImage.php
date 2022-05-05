<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class colorImage extends Model
{
    protected $guarded = ['id'];

    public function  getUrlAttribute(): ?string
    {
        if (empty($this->file_path)) {
            return null;
        }

        return Storage::disk('local')->url($this->file_path);
    }
}
