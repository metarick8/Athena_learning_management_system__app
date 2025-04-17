<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watch_later extends Model
{
    use HasFactory;
    protected $table='watch_later';
    protected $primaryKey = 'watch_later_id';
    protected $fillable = [
        'user_id',
        'course_id',
    ];
}
