<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Building;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Models\Person;
use App\Http\Requests\StoreCensoRequest;
use App\Enums\MonthEnums;

class CensosController extends Controller
{
    public function show()
    {
        $buildings = Building::all();
        return view('admin.censos.censoView')->with(['buildings' => $buildings]);
    }

    public function store(StoreCensoRequest $request)
    {
        $data = $request->validated();
        $person = Person::create($data);
        $buildings = Building::all();


        dd($data);

        if (isset($request->leader_family_id)) {
            $leader = Person::find($request->leader_family_id);
            return view('admin.censos.censoView')->with(['leader' => $leader, 'buildings' => $buildings]);
        }

        return view('admin.censos.censoView')->with(['leader' => $person, 'buildings' => $buildings]);
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

    public function search(Request $request)
    {
        $person = Person::with('apartment')->where('dni', $request->dni)->first();

        if ($request->check) {
            return response()->json(['person' => $person]);
        }

        if ($request->type == 'detail') {
            return view('admin.censos.detail')->with(['person' => $person]);
        }

        $buildings = Building::all();
        return view('admin.censos.censoView')->with(['leader' => $person, 'buildings' => $buildings]);
    }

    public function generate($dni)
    {
        $person = Person::with('apartment')->where('dni', $dni)->first();

        $data = [
            'person' => $person,
            'day' => date('d'),
            'month' => MonthEnums::tryFrom(date('m')),
            'year' => date('Y')
        ];

        $pdf = \PDF::loadView('admin.pdf.constancy', $data);
        $pdf->setPaper('a4');
        return $pdf->download('ejemplo.pdf');
    }

    public function deletePerson($person_id)
    {
        $person = Person::find($person_id);
        $person->delete();
        return response()->json([], 200);
    }
}
