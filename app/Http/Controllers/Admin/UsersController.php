<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    public function index(Request $request)
    {
         if ($request->ajax()) {

            $data = User::select('*');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){})
                ->make(true);
        }

        $roles = Role::all();
        return view('admin.users.index')->with(['roles' => $roles]);;
    }

    public function search(Request $request, $id)
    {
        $user = User::find($id);
        return response()->json(['user' => $user]);
    }

    public function store(UserRequest $request)
    {

        $data = $request->validated();
        $user = User::create($data);

        return redirect('users')->with('messages', 'Usuario registrado con exito!');
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);

        return redirect('users')->with('messages', 'Usuario actualizado con exito!');
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect('users')->with('messages', 'Usuario eliminado con exito!');
    }
}
