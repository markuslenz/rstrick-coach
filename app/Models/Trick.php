<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trick extends Model
{
    protected static function booted()
    {
        static::deleting(function ($trick) {
            $trick->attempts()->delete();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'url',
        'level',
        'judge_id',
        'description'
    ];

    /**
     * Get the judge associated with the trick
     */
    public function judge(): BelongsTo
    {
        return $this->belongsTo(Judge::class);
    }

    /**
     * Get the attempts associated with the trick
     */
    public function attempts(): HasMany
    {
        return $this->hasMany(Attempt::class);
    }
}
