<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Aluno;
use Illuminate\Http\Request;

class CadastrarAluno extends Controller
{
    /**
     * Cadastra um aluno para o professor
     *
     * @param Request $request
     * @param User $user
     * @return Aluno
     */
    public function __invoke(Request $request, User $user): Aluno
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'data_aula' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $dados = $request->all();
        $dados['user_id'] = $user->id;
        
        return $user->alunos()->create($dados);
    }
}
