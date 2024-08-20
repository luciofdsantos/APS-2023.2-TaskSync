<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioPostRequest;
use App\Http\Requests\UsuarioPostUpdateRequest;
use App\Models\User;
use App\Models\Usuario\TipoUsuario;
use App\Models\Usuario\Usuario;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    public function index()
    {
        $usuarios = Usuario::with('user')->paginate(10);

        flash('Welcome Aboard!')->success();

        return view('usuario.index', ['usuarios' => $usuarios]);
    }

    public function create()
    {
        $tipos = TipoUsuario::getAll();

        return view('usuario.create', ['tipos' => $tipos]);
    }

    public function salvar(UsuarioPostRequest $request)
    {
        $campos = $request->validated();
        $usuario = Usuario::create($campos);

        $user = new User([
            'id' => $usuario->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->save();



        event(new Registered($user));

        return redirect()->route('/usuario');
    }

    public function view(int $id)
    {

        $usuario = $this->findUsuario($id);

        return view('usuario.view', ['usuario' => $usuario]);
    }

    public function update(Usuario $usuario)
    {
        $tipos = TipoUsuario::getAll();

        return view('usuario.update', ['usuario' => $usuario, 'tipos' => $tipos]);
    }

    public function atualizar(UsuarioPostUpdateRequest $request, Usuario $usuario)
    {

        // dd($request->validated());
        $usuario->update($request->validated());

        $user = $usuario->user;
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return view('usuario.view', ['usuario' => $usuario]);
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('/usuario');
    }


    private function findUsuario(int $id)
    {
        try {
            $usuario = Usuario::find($id);
            if ($usuario) {
                return $usuario;
            }
        } catch (Exception $e) {
            abort(404, $e->getMessage());
        }
    }
}
