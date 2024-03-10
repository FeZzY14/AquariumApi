<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'type';
    protected $keyType = 'string';


    protected $fillable = [
        'type', 'unit',
    ];

    protected $table = 'sensor_type';

    public function getRouteKeyName()
    {
        return 'type';
    }
}
