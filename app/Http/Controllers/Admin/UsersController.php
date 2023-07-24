<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SecurityQuestion;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

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
        return view('admin.users.index')->with(['roles' => $roles]);
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

        $user = User::create($data);

        SecurityQuestion::create([
            'question' => $data['question'],
            'answer' => $data['answer'],
            'user_id' => $user->id
        ]);

        return redirect('users')->with('messages', 'Usuario registrado con exito!');
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', auth()->user());

        $data = $request->validated();

        if ($request->has('password') && !is_null($request->password)) {
            $data['password'] = Hash::make($data['password']);
        }
        else {
            unset($data['password']);
        }

        if ($request->has('question')) {
            if(isset($user->security_questions)) {

                $user->security_questions()->update([
                    'question' => $data['question'],
                    'answer' => $data['answer']
                ]);

            }
            else {

                $user->security_questions()->create([
                    'question' => $data['question'],
                    'answer' => $data['answer']
                ]);

            }
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

    public function recoverPassword(Request $request)
    {
        return view('auth.passwords.reset');
    }

    public function sendRecoverPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);
        
        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        }

        $user = User::with('security_questions')->where('email', $request->email)->first();

        return view('auth.passwords.reset_step1')->with(['user' => $user]);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'answer' => 'required|string',
            'password' => [
                'nullable', 
                'string',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::with('security_questions')->where('email', $request->email)->first();
        
        if ( $user->security_questions->answer == $request->answer) {
            
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            return view('auth.login')->with(['password_succesfully' => 'Contrasena actualizada cone exito']);

        }

        return view('auth.passwords.reset_step1')->with([
            'bad_answer' => 'Respuesta de seguridad incorrecta. Intente nuevamente!',
            'user' => $user
        ]);

    }

    public function unlock(User $user)
    {
        $user->update(['is_bloked' => 0]);
        return response()->json([], 200);
    }
}
