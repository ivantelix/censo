<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Building;
use Illuminate\Http\Request;

use App\Models\Person;
use App\Http\Requests\StoreCensoRequest;

class CensosController extends Controller
{
    public function show()
    {
        $buildings = Building::all();
        return view('admin.censos.show')->with(['buildings' => $buildings]);
    }

    public function store(StoreCensoRequest $request)
    {
        $data = $request->validated();
        $person = Person::create($data);

        return back()->with('messages', 'Jefe de familia registrado con exito!');
    }
}
