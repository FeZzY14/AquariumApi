<?php

namespace App\Http\Controllers\Api;

use App\Models\Measurement;
use App\Http\Requests\StoreMeasurementRequest;
use App\Http\Requests\UpdateMeasurementRequest;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\MeasurementResource;
use App\Http\Resources\MeasurementCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\Auth;

class MeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $measurements = QueryBuilder::for(Measurement::class)
            ->allowedFilters([
                AllowedFilter::exact('sensorNum'),
                AllowedFilter::exact('time'),
                AllowedFilter::exact('value'),

                AllowedFilter::exact('sensor.serialNum'),
                AllowedFilter::exact('sensor.aquariumId'),
                AllowedFilter::exact('sensor.sensor_type'),

                AllowedFilter::exact('aquarium.id'),
                AllowedFilter::exact('aquarium.user_id')
            ])->defaultSort('-time')->allowedSorts(['dataId', 'sensorNum'])->get();

        return MeasurementResource::collection($measurements);
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
    public function store(StoreMeasurementRequest $request)
    {
        $validate = $request->validated();

        $measurement = Measurement::create($validate);

        return new MeasurementResource($measurement);
    }

    /**
     * Display the specified resource.
     */
    public function show(Measurement $measurement)
    {
        return new MeasurementResource($measurement);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Measurement $measurement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMeasurementRequest $request, Measurement $measurement)
    {
        $validated = $request->validated();

        $measurement->update($validated);

        return new MeasurementResource($measurement);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Measurement $measurement)
    {
        $measurement->delete();

        return response()->noContent();
    }
}
