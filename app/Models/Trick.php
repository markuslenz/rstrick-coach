<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trick extends Model
{
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
}
