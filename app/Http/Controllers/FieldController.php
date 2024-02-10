<?php

namespace App\Http\Controllers;

use App\Services\Fields\FindField;
use App\Services\Fields\ListField;
use App\Services\Fields\CreateField;
use App\Services\Fields\UpdateField;
use App\Services\Fields\DeleteField;

use App\Http\Resources\FieldResource;
use App\Http\Resources\FieldCollection;
use App\Http\Requests\StoreFieldRequest;
use App\Http\Requests\UpdateFieldRequest;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = request('order', '');
        $search = request('search', '');
        $typeResult = request('type_result', 'pagination');

        $fields = ListField::call($order, $search);

        if ($typeResult === 'select') {
            return $fields->pluck('name', 'id');
        }

        return new FieldCollection($fields->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFieldRequest $request)
    {
        $blueprint = $this->storeBlueprint($request);
        $data = $request->all();
        $data['blueprint'] = $blueprint;
        $field = CreateField::call($data);

        return response()->json(new FieldResource($field), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $field = FindField::call($id);
        return new FieldResource($field);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFieldRequest $request, string $id)
    {
        $blueprint = $this->storeBlueprint($request);
        $data = $request->all();
        $data['blueprint'] = $blueprint;

        $field = UpdateField::call($id, $data);

        return response()->json(new FieldResource($field), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DeleteField::call($id);
        return response()->json(null, 204);
    }

    protected function storeBlueprint(UpdateFieldRequest | StoreFieldRequest $request)
    {
        if (!$request->hasFile('blueprint')) {
            return null;
        }

        return $request->file('blueprint')->store(options: 'blueprints');
    }
}
