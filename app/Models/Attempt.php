<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attempt extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'trick_id',
        'judge_id',
        'level',
        'is_correct'
    ];

    /**
     * Get the trick associated with the attempt
     */
    public function trick(): BelongsTo
    {
        return $this->belongsTo(Trick::class);
    }


    /**
     * Get the user associated with the attempt
     */
    public function user(): BelongsTo
    {   
        return $this->belongsTo(User::class);
    }


    /**
     * Get the judge associated with the attempt
     */
    public function judge(): BelongsTo
    {
        return $this->belongsTo(Judge::class);
    }
}
