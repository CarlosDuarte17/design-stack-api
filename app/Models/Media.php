<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'path',
        'source',
        'type',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getFullPathAttribute(): string
    {
        return $this->source.$this->path;
    }

}
