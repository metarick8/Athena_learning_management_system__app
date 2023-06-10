<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Module extends Model
{
    use HasFactory;
    protected $primaryKey = 'module_id';
    protected $fillable = [
        'course_id',
        'title',
        'path',
        'total_videos',
        'has_quiz',
    ];

    public function course(): BelongsTo{
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }
    public function videos(): HasMany{
        return $this->hasMany(Video::class, 'module_id', 'module_id');
    }
    public function quiz(): HasOne{
        return $this->hasOne(Quiz::class, 'module_id', 'module_id');
    }
}
