<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('index', auth()->user());
        
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
        $this->authorize('search', auth()->user());

        $user = User::find($id);
        return response()->json(['user' => $user]);
    }

    public function store(UserRequest $request)
    {

        $this->authorize('store', auth()->user());

        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect('users')->with('messages', 'Usuario registrado con exito!');
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', auth()->user());

        $data = $request->validated();

        if ($request->has('password')) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return redirect('users')->with('messages', 'Usuario actualizado con exito!');
    }

    public function delete(User $user)
    {
        $this->authorize('delete', auth()->user());

        $user->delete();
        return redirect('users')->with('messages', 'Usuario eliminado con exito!');
    }

    public function unlock(User $user)
    {
        $user->update(['is_bloked' => 0]);
        return response()->json([], 200);
    }
}
