<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rate extends Model
{
    use HasFactory;
    protected $primaryKey = 'rate_id';
    protected $fillable = [
        'user_id',
        'course_id',
        'rate',
        'opinion',
    ];

}
