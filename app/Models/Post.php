<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'color', 'content', 'thumbnail', 'tags', 'published', 'category_id'];

    protected $casts = [
        'tags' => 'array',
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
