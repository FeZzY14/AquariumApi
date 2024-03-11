<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Sensor extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'serialNum', 'aquariumId', 'sensor_type', 'senName',
    ];

    protected $table = 'sensor';

    protected $primaryKey = 'serialNum';
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'serialNum';
    }

    /**
     * Get the aquarium that owns the Sensor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function aquarium(): BelongsTo
    {
        return $this->belongsTo(Aquarium::class, 'aquariumId', 'id');
    }

    /**
     * Get all of the measurements for the Sensor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function measurements(): HasMany
    {
        return $this->hasMany(Measurement::class, 'sensorNum', 'serialNum');
    }

    /**
     * Get the type that owns the Sensor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(SensorType::class, 'sensor_type', 'type');
    }


    protected static function booted(): void
    {
        static::addGlobalScope('user', function(Builder $buider) {
            $buider->join('aquarium', 'sensor.aquariumId', 'aquarium.id')->where('user_id', Auth::id());
        });
    }
}
