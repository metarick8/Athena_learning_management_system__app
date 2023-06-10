<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subscription_for_private extends Model
{
    use HasFactory;
    protected $primaryKey = 'subscription_for_private_id';
    protected $fillable = [
        'user_id',
        'private_course_id',
    ];
}
