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
        return view('admin.censos.show')->with(['buildings' => $buildings]);
    }

    public function store(StoreCensoRequest $request)
    {
        $data = $request->validated();
        $person = Person::create($data);
        $buildings = Building::all();

        if (isset($request->leader_family_id)) {
            $leader = Person::find($request->leader_family_id);
            return view('admin.censos.show')->with(['leader' => $leader, 'buildings' => $buildings]);
        }

        return view('admin.censos.show')->with(['leader' => $person, 'buildings' => $buildings]);
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
