<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $primaryKey = 'admin_id';
    protected $fillable = [
        'first_name',
        'last_name',
        'password',
    ];
}
