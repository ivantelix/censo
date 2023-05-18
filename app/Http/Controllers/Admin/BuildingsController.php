<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;

use App\Models\Building;
use App\Http\Requests\BuildingRequest;
use App\Http\Resources\BuildingResource;

class BuildingsController extends Controller
{
    public function index(Request $request)
    {
         if ($request->ajax()) {

            $data = Building::select('*');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){})
                ->make(true);
        }

        return view('admin.buildings.index');
    }

    public function search(Request $request, $id)
    {
        $building = Building::find($id);

        if ($request->ajax()) {
            return new BuildingResource($building);
        }

        return true;
    }

    public function store(BuildingRequest $request)
    {

        $data = $request->validated();
        $building = Building::create($data);

        return redirect('buildings')->with('messages', 'Edificio registrado con exito!');
    }

    public function update(BuildingRequest $request, Building $building)
    {
        $data = $request->validated();
        $building->update($data);

        return redirect('buildings')->with('messages', 'Edificio Actualizado con exito!');
    }
}
