<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Building;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Models\Person;
use App\Http\Requests\StoreCensoRequest;

class CensosController extends Controller
{
    public function show()
    {
        $buildings = Building::all();
        $person = Person::first(); //Eliminar esto luego de finalizar
        return view('admin.censos.show')->with(['leader' => $person, 'buildings' => $buildings]);
    }

    public function store(StoreCensoRequest $request)
    {
        $data = $request->validated();
        $person = Person::create($data);

        if (!$request->leader_family_id) {
            $buildings = Building::all();
            return view('admin.censos.show')->with(['leader' => $person, 'buildings' => $buildings]);
        }

        return redirect('censos')->with('messages', 'Lider registrado con exito!');
    }

    public function getFamilyLeader(Request $request, $leader_id=null)
    {
        if ($leader_id) {
            $data = Person::where('leader_family_id', $request->leader_id)->select('*');
        }
        else {
            $data = [];
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){})
            ->make(true);
    }
}
