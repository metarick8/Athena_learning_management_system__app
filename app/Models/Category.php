<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'name',
    ];

    public function courses(): HasMany{
        return $this->hasMany(Course::class, 'category_id', 'category_id');
    }
    public function tutors(): BelongsToMany{
        return $this->belongsToMany(Tutor::class, 'category_tutor', 'category_id', 'tutor_id');
    }
}
