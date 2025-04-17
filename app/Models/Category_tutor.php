<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_tutor extends Model
{
    use HasFactory;
    protected $primaryKey = 'category_tutor_id';
    protected $fillable = [
        'tutor_id',
        'category_id',
    ];
}
