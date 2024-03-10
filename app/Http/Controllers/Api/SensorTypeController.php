<?php

namespace App\Http\Controllers\Api;

use App\Models\SensorType;
use App\Http\Requests\StoreSensorTypeRequest;
use App\Http\Requests\UpdateSensorTypeRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\SensorTypeResource;
use Spatie\QueryBuilder\QueryBuilder;

class SensorTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sensorTypes = QueryBuilder::for(SensorType::class)
            ->allowedFilters('type')
            ->get();

        return $sensorTypes;
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
    public function store(StoreSensorTypeRequest $request)
    {
        $validated = $request->validated();

        $sensorType = SensorType::create($validated);

        return $sensorType;
    }

    /**
     * Display the specified resource.
     */
    public function show(SensorType $sensorType)
    {
        return $sensorType;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SensorType $sensorType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSensorTypeRequest $request, SensorType $sensorType)
    {
        $validated = $request->validated();

        $sensorType->update($validated);

        return $sensorType;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SensorType $sensorType)
    {
        $sensorType->delete();

        return response()->noContent();
    }
}
