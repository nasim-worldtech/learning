<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['mimeType',
        'original_name',
        'path',
        'size',
        'disk',
        'created_at',
        'updated_at',
    ];
}
