<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;


class Aquarium extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    protected $table = 'aquarium';

    /**
     * Get all of the Sensors for the Aquarium
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sensors(): HasMany
    {
        return $this->hasMany(Sensor::class, 'aquariumId', 'id');
    }

    /**
     * Get the user that owns the Aquarium
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected static function booted(): void
    {
        static::addGlobalScope('user', function(Builder $buider) {
            $buider->where('user_id', Auth::id());
        });
    }
}
