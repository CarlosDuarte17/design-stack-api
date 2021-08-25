<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'media_path',
        'media_source',
        'type',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getmediaFullPathAttribute(): string
    {
        return $this->media_source.$this->media_path;
    }

}
