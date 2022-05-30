<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AutenticacaoController extends Controller
{
    /**
     * Realiza a criação de um token de acesso.
     *
     * @param Request $request
     * @return array
     */
    public function login(Request $request): array
    {   
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $estaLogado = Auth::attempt($request->only('email', 'password'));

        if (!$estaLogado) {
            return [
                'message' => 'Usuário ou senha inválidos.',
            ];
        }

        $token = $request->user()->createToken($request->dispositivo);

        return [
            'user' => Auth::user(),
            'token' => $token->plainTextToken
        ];
    }

    /* 
     * Realiza o logout do usuário.
     *
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();

        return response(['message' => 'Logout efetuado com sucesso!']);
    }
}
