<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attached_file extends Model
{
    use HasFactory;
    protected $primaryKey = 'attached_file_id';
    protected $fillable = [
        'course_id',
        'video_id',
        'pic_path',
        'intro_path',
    ];

    public function course(): BelongsTo{
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }
    public function video(): BelongsTo{
        return $this->belongsTo(video::class, 'video_id', 'video_id');
    }
}
