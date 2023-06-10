<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;
    protected $primaryKey = 'course_id';
    protected $fillable = [
        'tutor_id',
        'category_id',
        'title',
        'description',
        'price',
        'level',
        'total_course_duration',
        'total_modules',
    ];

    public function tutor(): BelongsTo{
        return $this->belongsTo(Tutor::class, 'tutor_id', 'tutor_id');
    }
    public function category(): BelongsTo{
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    public function modules(): HasMany{
        return $this->hasMany(Module::class, 'course_id', 'course_id');
    }
    public function attached_files(): HasMany{
        return $this->hasMany(Attached_file::class, 'course_id', 'course_id');
    }
    public function users(): BelongsToMany{
        return $this->belongsToMany(User::class, 'watch_later', 'course_id', 'user_id');
    }
    public function courses(): BelongsToMany{
        return $this->belongsToMany(User::class, 'subscriptions', 'course_id', 'user_id')
        ->using(Subscription::class);
    }
    public function users_rate(): BelongsToMany{
        return $this->belongsToMany(User::class, 'rates', 'course_id', 'user_id')
        ->using(Rate::class)
        ->withPivot('rate','opinion')
        ->withTimestamps();
    }
}
