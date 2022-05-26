<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Database\Eloquent\Collection;

class UsuarioController extends Controller
{
    /**
     * Retorna os usuários cadastrados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): Collection
    {
        $busca = '%' . $request->query('q', '') . '%';

        $users = User::where('descricao', 'like', $busca)->get();

        return $users;
    }

    /**
     * Mostra um usuário específico.
     *
     * @param  User $user
     * @return User
     */
    public function show(User $user): User
    {
        return $user;
    }
    
    /**
     * Cadastra um novo usuário
     *
     * @param UsuarioRequest $request
     * @return array
     */
    public function store(UsuarioRequest $request): array
    {
        $dados = $request->all();
        $dados['password'] = Hash::make($dados['password']);

        $user = User::create($dados);

        Auth::attempt(
            [
                'email' => $user->email,
                'password' => $request->password
            ]
        );

        $token = $request->user()->createToken('Primeiro Login')->plainTextToken;

        return compact('user', 'token');
    }
    
    /**
     * Atualiza um usuário
     *
     * @param UsuarioRequest $request
     * @return User
     */
    public function update(UsuarioRequest $request): User
    {
        $dados = $request->all();
        $dados['password'] = Hash::make($dados['password']);

        $user = Auth::user();
        $user->update($dados);

        return $user;
    }

    /**
     * Remove um usuário
     *
     * @return Response
     */
    public function destroy(): Response
    {
        request()->user()->currentAccessToken()->delete();

        $user = Auth::user();
        $user->delete();
        
        return response(null, 204);
    }
}
