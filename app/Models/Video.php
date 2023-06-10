<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Video extends Model
{
    use HasFactory;
    protected $primaryKey = 'video_id';
    protected $fillable = [
        'module_id',
        'title',
        'duration',
        'path',
    ];



    public function attached_file(): HasOne{
        return $this->hasOne(Attached_file::class, 'video_id', 'video_id');
    }
    public function module(): BelongsTo{
        return $this->belongsTo(Module::class, 'module_id', 'module_id');
    }
    public function users_b(): BelongsToMany{
        return $this->belongsToMany(User::class, 'bookmarks', 'video_id', 'user_id')
        ->using(Bookmark::class)
        ->withPivot('title', 'duration');
    }
    public function users_p(): BelongsToMany{
        return $this->belongsToMany(User::class, 'progressions', 'video_id', 'user_id')
        ->using(Progression::class)
        ->withPivot('progress_percent', 'finished');
    }
}
