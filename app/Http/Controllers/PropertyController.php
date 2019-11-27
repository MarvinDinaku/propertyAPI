<?php

namespace App\Http\Controllers;

use App\Http\Resources\PropertyResource;
use App\Http\Resources\PropertyResourceCollection;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{

    /**
     * @return PropertyResourceCollection
     */
    public function index():PropertyResourceCollection
    {
    return new PropertyResourceCollection(Property::paginate());
    }

    /**
     * @param Property $property
     * @return PropertyResource
     */
    public function show(Property $property): PropertyResource
    {
        return new PropertyResource($property);
    }

    /**
     * @param Request $request
     * @return PropertyResource
     */

    public function store(Request $request)
    {
        $property = new Property();

        $property = Property::create($request->all());

        return new PropertyResource($property);
    }

    /**
     * @param Property $property
     * @param Request $request
     * @return PropertyResource
     */
    public function update(Property $property,Request $request): PropertyResource
    {
        $property->update($request->all());

        return new PropertyResource($property);

    }

    /**
     * @param Property $property
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return response()->json();
    }
}
