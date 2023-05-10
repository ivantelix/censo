<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuildingRequest;
use App\Http\Resources\BuildingResource;
use App\Models\Building;
use Illuminate\Http\Request;

class BuildingsController extends Controller
{
    public function index(Request $request)
    {
        $buildongs = Building::all();
        return new BuildingResource($buildongs);
    }

    public function search($id)
    {
        $building = Building::find($id);
        return new BuildingResource($building);
    }

    public function store(BuildingRequest $request)
    {
        $data = $request->validate();
        $building = Building::create($data);
        return new BuildingResource($building);
    }
}
