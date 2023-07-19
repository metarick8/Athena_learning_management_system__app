<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progression extends Model
{
    use HasFactory;
    protected $primaryKey = 'progression_id';
    protected $fillable = [
        'user_id',
        'video_id',
        'percent',
        'is_finished',
    ];
}
