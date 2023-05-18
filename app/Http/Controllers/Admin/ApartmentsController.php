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

            $data = Apartment::with('building')->select('*');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){})
                ->make(true);
        }

        $buildings = Building::all();

        return view('admin.apartments.index')->with(['buildings' => $buildings]);
    }

    public function search(Request $request, $id)
    {
        $apartment = Apartment::with(['building'])->find($id);

        if ($request->ajax()) {
            return new ApartmentResource($apartment);
        }

        return true;
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
}
