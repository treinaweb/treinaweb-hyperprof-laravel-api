<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EnviarFotoUsuario extends Controller
{
    /**
     * Envia a foto do usuário para o servidor.
     *
     * @param Request $request
     * @param User $user
     * @return User
     */
    public function __invoke(Request $request, User $user): User
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $caminhoFoto = $request->file('foto')->store('public/professores');

        $user->update([
            'foto' => $caminhoFoto,
        ]);

        return $user;
    }
}
