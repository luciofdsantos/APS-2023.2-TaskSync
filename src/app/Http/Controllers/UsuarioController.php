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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\error;

class UsuarioController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('usuarios', Usuario::class);

        $usuarios = Usuario::with('user')->paginate(10);

        return view('usuario.index', ['usuarios' => $usuarios]);
    }

    public function create()
    {
        $this->authorize('usuarios', Usuario::class);
        $tipos = TipoUsuario::getAll();

        return view('usuario.create', ['tipos' => $tipos]);
    }

    public function salvar(UsuarioPostRequest $request)
    {
        $this->authorize('usuarios', Usuario::class);
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

        return redirect()->route('usuario.view',  ['id' => $usuario->id]);
    }

    public function view(int $id)
    {
        $this->authorize('usuarios', Usuario::class);
        $usuario = $this->findUsuario($id);

        return view('usuario.view', ['usuario' => $usuario]);
    }

    public function update(Usuario $usuario)
    {
        $this->authorize('usuarios', Usuario::class);
        $tipos = TipoUsuario::getAll();

        return view('usuario.update', ['usuario' => $usuario, 'tipos' => $tipos]);
    }

    public function atualizar(UsuarioPostUpdateRequest $request, Usuario $usuario)
    {
        $this->authorize('usuarios', Usuario::class);
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
        $this->authorize('usuarios', Usuario::class);
        try {
            $usuario->delete();
        } catch (Exception $e) {
            return redirect()->route('/usuario')->with('danger', 'Não foi possível excluir este usuário.');
        }
        return redirect()->route('/usuario');
    }


    private function findUsuario(int $id)
    {
        $this->authorize('usuarios', Usuario::class);
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
