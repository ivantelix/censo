<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;

use App\Models\Building;
use App\Models\Apartment;
use App\Http\Requests\ApartmentRequest;
use App\Http\Resources\ApartmentResource;

class ApartmentsController extends Controller
{
    public function index(Request $request)
    {
         if ($request->ajax()) {

            $data = Apartment::with('buildings')->select('*');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    
                })
                ->make(true);
        }

        $buildings = Building::all();

        return view('admin.apartments.index')->with(['buildings' => $buildings]);
    }

    public function search(Request $request, $id)
    {
        $Apartment = Apartment::find($id);

        if ($request->ajax()) {
            return new ApartmentResource($Apartment);
        }

        return true;
    }

    public function store(ApartmentRequest $request)
    {

        $data = $request->validated();
        $Apartment = Apartment::create($data);

        return redirect('Apartments')->with('messages', 'Edificio registrado con exito!');
    }

    public function update(ApartmentRequest $request, Apartment $Apartment)
    {
        $data = $request->validated();
        $Apartment->update($data);

        return redirect('Apartments')->with('messages', 'Edificio Actualizado con exito!');
    }
}
