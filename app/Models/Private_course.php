<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Private_course extends Model
{
    use HasFactory;
    protected $primaryKey = 'private_course_id';
    protected $fillable = [
        'tutor_id',
        'title',
        'price',
        'appointment',
        'description',
        'finished',
    ];

    public function tutor(): BelongsTo{
        return $this->belongsTo(Tutor::class, 'tutor_id', 'tutor_id');
    }
    public function users(): BelongsToMany{
        return $this->belongsToMany(User::class, 'subscription_for_privates', 'private_course_id', 'user_id')
        ->using(Private_course::class);
    }
}
