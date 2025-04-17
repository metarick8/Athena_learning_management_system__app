<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quiz extends Model
{
    use HasFactory;
    protected $primaryKey = 'quiz_id';
    protected $fillable = [
        'module_id',
        'path',
    ];

    public function video(): BelongsTo{
        return $this->belongsTo(Module::class, 'module_id', 'module_id');
    }
}
