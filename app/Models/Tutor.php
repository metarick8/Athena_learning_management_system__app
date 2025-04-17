<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tutor extends Model
{
    use HasFactory;

    protected $primaryKey = 'tutor_id';
    protected $fillable = [
        'user_id',
        'bio',
        'rate',
        'id_photo',
        'certification',
        'c_v',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function private_courses(): HasMany{
        return $this->hasMany(Private_course::class, 'tutor_id', 'tutor_id');
    }
    public function courses(): HasMany{
        return $this->hasMany(Course::class, 'tutor_id', 'tutor_id');
    }
    public function users_follow(): BelongsToMany{
        return $this->belongsToMany(User::class, 'follow', 'tutor_id', 'user_id ');
    }
    public function users_fan(): BelongsToMany{
        return $this->belongsToMany(User::class, 'fan', 'tutor_id', 'user_id ');
    }
    public function categories(): BelongsToMany{
        return $this->belongsToMany(Category::class, 'category_tutor', 'tutor_id', 'category_id');
    }
}
