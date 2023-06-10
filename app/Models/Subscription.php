<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subscription extends Model
{
    use HasFactory;
    protected $primaryKey = 'subscription_id';
    protected $fillable = [
        'user_id',
        'course_id',
    ];

}
