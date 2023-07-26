<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'picture',
        'gender',
        'phone_number',
        'budget',
        'email',
        'password',
        'is_tutor'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function tutor(): HasOne{
        return $this->hasOne(Tutor::class, 'user_id', 'user_id');
    }
    public function tutors_follow(): BelongsToMany{
        return $this->belongsToMany(Tutor::class, 'follow', 'user_id', 'tutor_id');
    }
    public function tutors_fan(): BelongsToMany{
        return $this->belongsToMany(Tutor::class, 'fan', 'user_id', 'tutor_id');
    }
    public function watch_laters(): BelongsToMany{
        return $this->belongsToMany(Course::class, 'watch_later', 'user_id', 'course_id');
    }
    public function courses(): BelongsToMany{
        return $this->belongsToMany(Course::class, 'subscriptions', 'user_id', 'course_id')
        ->using(Subscription::class);
    }

    public function videos_b(): BelongsToMany{
        return $this->belongsToMany(Video::class, 'bookmarks', 'user_id', 'video_id')
        ->using(Bookmark::class)
        ->withPivot('title', 'duration');
    }
    public function videos_p(): BelongsToMany{
        return $this->belongsToMany(Video::class, 'progressions', 'user_id', 'video_id')
        ->using(Progression::class)
        ->withPivot('progress_percent', 'finished');
    }
    public function pirvate_course(): BelongsToMany{
        return $this->belongsToMany(Private_course::class, 'subscription_for_privates', 'user_id', 'subscription_for_private_id')
        ->using(Private_course::class);
    }
    public function courses_rate(): BelongsToMany{
        return $this->belongsToMany(Course::class, 'rates', 'user_id', 'course_id')
        ->using(Rate::class)
        ->withPivot('rate','opinion')
        ->withTimestamps();
    }

}
