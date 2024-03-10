<?php

namespace App\Http\Controllers\Api;

use App\Models\Aquarium;
use App\Http\Requests\StoreAquariumRequest;
use App\Http\Requests\UpdateAquariumRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\AquariumResource;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Auth;

class AquariumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aquariums = QueryBuilder::for(Aquarium::class)
            ->allowedFilters('name')
            ->get();

        return AquariumResource::collection($aquariums);
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
    public function store(StoreAquariumRequest $request)
    {
        $validated = $request->validated();

        $aquarium = Auth::user()->aquariums()->create($validated);

        return new AquariumResource($aquarium);
    }

    /**
     * Display the specified resource.
     */
    public function show(Aquarium $aquarium)
    {
        return new AquariumResource($aquarium);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aquarium $aquarium)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAquariumRequest $request, Aquarium $aquarium)
    {
        $validated = $request->validated();

        $aquarium->update($validated);

        return new AquariumResource($aquarium);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aquarium $aquarium)
    {
        $aquarium->delete();

        return response()->noContent();
    }
}
