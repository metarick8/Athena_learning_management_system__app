<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Rate;
use App\Models\Subscription;


class Course extends Model
{
    use HasFactory;
    protected $primaryKey = 'course_id';
    protected $appends = [
        'rate',
        'Subscribers'
    ];
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

    public function getRateAttribute()
    {
        $r = Rate::where('course_id', $this->course_id)->avg('rate');
        if ($r != null)
            return Rate::where('course_id', $this->course_id)->avg('rate');
        return 0;
    }
    public function getSubscribersAttribute()
    {
        $r = Subscription::where('course_id', $this->course_id)->count();
        if ($r != null)
            return Subscription::where('course_id', $this->course_id)->count();
        return 0;
    }

    public function tutor(): BelongsTo
    {
        return $this->belongsTo(Tutor::class, 'tutor_id', 'tutor_id');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    public function modules(): HasMany
    {
        return $this->hasMany(Module::class, 'course_id', 'course_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'watch_later', 'course_id', 'user_id');
    }
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'subscriptions', 'course_id', 'user_id')
            ->using(Subscription::class);
    }
    public function users_rate(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'rates', 'course_id', 'user_id')
            ->using(Rate::class)
            ->withPivot('rate', 'opinion')
            ->withTimestamps();
    }
}
