<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;

use App\Models\Building;
use App\Models\Apartment;
use App\Models\Person;
use App\Http\Requests\ApartmentRequest;
use App\Http\Resources\ApartmentResource;

class ApartmentsController extends Controller
{
    public function index(Request $request)
    {
         if ($request->ajax()) {

            $data = Apartment::with('building')->select('*');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){})
                ->make(true);
        }

        $buildings = Building::all();

        return view('admin.apartments.index')->with(['buildings' => $buildings]);
    }

    public function search(Request $request, $id=null)
    {
        if ( $request->has('building_id') ) {
            $data = Apartment::where('building_id', $request->building_id)->get();
            return ApartmentResource::collection($data);
        }
        else {
            $data = Apartment::with(['building'])->find($id);
            return new ApartmentResource($data);
        }
    }

    public function store(ApartmentRequest $request)
    {

        $data = $request->validated();
        $Apartment = Apartment::create($data);

        return redirect('apartments')->with('messages', 'Apartamento registrado con exito!');
    }

    public function update(ApartmentRequest $request, Apartment $Apartment)
    {
        $data = $request->validated();
        $Apartment->update($data);

        return redirect('apartments')->with('messages', 'Apartamento Actualizado con exito!');
    }

    public function delete(Apartment $Apartment)
    {
        $Apartment->delete();
        return redirect('apartments')->with('messages', 'Apartamento eliminado con exito!');
    }

    public function listfamily($appartment_id)
    {
        $buildings = Building::all();
        $person = Person::with('apartment.building')->where([
                'apartment_id' => $appartment_id,
                'is_leader' => 1
            ])->first();

        return view('admin.censos.censoView')->with(['leader' => $person, 'buildings' => $buildings]);
    }
}
