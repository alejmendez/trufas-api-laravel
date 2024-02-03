<?php

namespace App\Http\Controllers;

use App\Services\Plants\FindPlant;
use App\Services\Plants\ListPlant;
use App\Services\Plants\CreatePlant;
use App\Services\Plants\UpdatePlant;
use App\Services\Plants\DeletePlant;

use App\Http\Resources\PlantResource;
use App\Http\Resources\PlantCollection;
use App\Http\Requests\StorePlantRequest;
use App\Http\Requests\UpdatePlantRequest;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = request('order', '');
        $search = request('search', '');
        $plant = ListPlant::call($order, $search);

        return new PlantCollection($plant->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlantRequest $request)
    {
        $blueprint = $this->storeBlueprint($request);
        $data = $request->all();
        $data['blueprint'] = $blueprint;
        $plant = CreatePlant::call($data);

        return response()->json(new PlantResource($plant), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $plant = FindPlant::call($id);
        return new PlantResource($plant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlantRequest $request, string $id)
    {
        $blueprint = $this->storeBlueprint($request);
        $data = $request->all();
        $data['blueprint'] = $blueprint;

        $plant = UpdatePlant::call($id, $data);

        return response()->json(new PlantResource($plant), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DeletePlant::call($id);
        return response()->json(null, 204);
    }

    protected function storeBlueprint(UpdatePlantRequest | StorePlantRequest $request)
    {
        if (!$request->hasFile('blueprint')) {
            return null;
        }

        return $request->file('blueprint')->store(options: 'blueprints');
    }
}
