<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Trick extends Model
{
    protected static function booted()
    {
        static::deleting(function ($trick) {
            $trick->attempts()->delete();
            if($trick->video_url && Storage::disk('public')->exists($trick->video_url)) {
                Storage::disk('public')->delete($trick->video_url);
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'youtube',
        'video_url',
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

    /**
     * Get translation relation
     */
    public function translations(): HasMany
    {
        return $this->hasMany(TrickTranslation::class);
    }

    /**
     * Get translation in selected locale
     */
    public function translation($locale = null)
    {
        $locale ??= app()->getLocale();

        return $this->translations->where('locale', $locale)->first();
    }
}
