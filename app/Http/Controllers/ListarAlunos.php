<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ListarAlunos extends Controller
{
    /**
     * Retorna a lista de alunos de um professor
     *
     * @return Collection
     */
    public function __invoke(): Collection
    {
        return Auth::user()->alunos()->with('user')->get();
    }
}
