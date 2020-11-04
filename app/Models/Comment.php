<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * Post that the comment belongs to
     */
    public function posts() {
        return $this->belongsToMany(Post::class)->withTimestamp();
    }
}
