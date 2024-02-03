<?php

namespace App\Http\Controllers;

use App\Services\Quarters\FindQuarter;
use App\Services\Quarters\ListQuarter;
use App\Services\Quarters\CreateQuarter;
use App\Services\Quarters\UpdateQuarter;
use App\Services\Quarters\DeleteQuarter;

use App\Http\Resources\QuarterResource;
use App\Http\Resources\QuarterCollection;
use App\Http\Requests\StoreQuarterRequest;
use App\Http\Requests\UpdateQuarterRequest;

class QuarterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = request('order', '');
        $search = request('search', '');
        $quarter = ListQuarter::call($order, $search);

        return new QuarterCollection($quarter->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuarterRequest $request)
    {
        $blueprint = $this->storeBlueprint($request);
        $data = $request->all();
        $data['blueprint'] = $blueprint;
        $Quarter = CreateQuarter::call($data);

        return response()->json(new QuarterResource($Quarter), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Quarter = FindQuarter::call($id);
        return new QuarterResource($Quarter);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuarterRequest $request, string $id)
    {
        $blueprint = $this->storeBlueprint($request);
        $data = $request->all();
        $data['blueprint'] = $blueprint;

        $Quarter = UpdateQuarter::call($id, $data);

        return response()->json(new QuarterResource($Quarter), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DeleteQuarter::call($id);
        return response()->json(null, 204);
    }

    protected function storeBlueprint(UpdateQuarterRequest | StoreQuarterRequest $request)
    {
        if (!$request->hasFile('blueprint')) {
            return null;
        }

        return $request->file('blueprint')->store(options: 'blueprints');
    }
}
