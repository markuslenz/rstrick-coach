<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrickTranslation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'locale',
        'title',
        'description'
    ];

    /**
     * Get the trick associated to the translation
     */
    public function trick(): BelongsTo
    {
        return $this->belongsTo(Trick::class);
    }
}
