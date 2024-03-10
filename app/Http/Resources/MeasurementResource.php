<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SensorCollection;

class MeasurementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'dataId' => $this->dataId,
            'sensorNum' => $this->sensorNum,
            'value' => $this->value,
            'time' => $this->time,
            'unit'=> $this->sensor->type->unit
        ];
    }
}
