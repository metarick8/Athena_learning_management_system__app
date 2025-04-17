<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;
    protected $primaryKey = 'bookmark_id';
    protected $fillable = [
        'user_id',
        'video_id',
        'title',
        'duration',
    ];
}
