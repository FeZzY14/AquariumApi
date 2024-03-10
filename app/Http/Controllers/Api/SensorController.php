<?php

namespace App\Http\Controllers\Api;

use App\Models\Sensor;
use App\Models\Measurement;
use App\Http\Requests\StoreSensorRequest;
use App\Http\Requests\UpdateSensorRequest;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\SensorResource;
use App\Http\Resources\MeasurementResource;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sensors = QueryBuilder::for(Sensor::class)
            ->allowedFilters([
                AllowedFilter::exact('aquariumId'),
                AllowedFilter::exact('sensor_type'),
                AllowedFilter::exact('senName'),
                AllowedFilter::exact('serialNum')
            ])
            ->allowedIncludes('measurements')
            ->get();

        return SensorResource::collection($sensors);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSensorRequest $request)
    {
        $validate = $request->validated();

        $sensor = Sensor::create($validate);

        return new SensorResource($sensor);

    }

    /**
     * Display the specified resource.
     */

     public function show(Sensor $sensor)
     {
         return new SensorResource($sensor->load('measurements'));
     }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sensor $sensor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSensorRequest $request, Sensor $sensor)
    {
        $validated = $request->validated();

        $sensor->update($validated);

        return new SensorResource($sensor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sensor $sensor)
    {
        $sensor->delete();

        return response()->noContent();
    }
}
