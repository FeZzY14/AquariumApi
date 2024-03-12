<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SensorTypeResource;
use App\Http\Resources\MeasurementResource;

class SensorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "serialNum" => $this->serialNum,
            "aquariumId"=> $this->aquariumId,
            "sensor_type" => $this->sensor_type,
            "senName" => $this->senName,
            "measurements" => MeasurementResource::collection($this->whenLoaded('measurements'))->sortByDesc('time')
        ];
    }
}
