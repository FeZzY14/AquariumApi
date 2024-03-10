<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;



class Measurement extends Model
{
    use HasFactory;

    protected $primaryKey = 'dataId';
    protected $keyType = 'integer';

    protected $fillable = [
        'value', 'sensorNum', 'time',
    ];

    public $timestamps = false;

    protected $table = 'Measurement';

    /**
     * Get the sensor that owns the Measurement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sensor(): BelongsTo
    {
        return $this->belongsTo(Sensor::class, 'sensorNum', 'serialNum');
    }

    protected static function booted(): void
    {
        static::addGlobalScope('user', function(Builder $buider) {
            $buider->join('sensor','sensor.serialNum', 'measurement.sensorNum')
            ->join('aquarium', 'aquarium.id', 'sensor.aquariumId')
            ->where('user_id', Auth::id());
        });
    }
}
