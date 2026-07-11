<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'name',
        'file_path',
        'file_type',
        'section_type',
        'file_size',
        'mime_type',
        'description',
    ];

    public function getUrlAttribute()
    {
        return asset($this->file_path);
    }
}
