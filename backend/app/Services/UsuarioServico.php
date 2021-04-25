<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\UsuarioModel;
use App\Repositories\UsuarioRepositorio;
use Illuminate\Support\Facades\Hash;

class UsuarioServico
{
    protected $repositorio;

    public function __construct(UsuarioRepositorio $usuarioRepositorio)
    {
        $this->repositorio = $usuarioRepositorio;
    }

    public function save(array $input): array
    {
        $dados = $this->tratarInput($input);

        $resposta = $this->repositorio->save($dados);

        return $this->tratarOutput($resposta);
    }

    protected function tratarOutput(UsuarioModel $usuarioModel): array
    {
        return [
            'login' => $usuarioModel->usua_login,
            'clienteId' => $usuarioModel->cliente_id,
            'firstAccess' => $usuarioModel->usua_first_access,
            'emailVerifiedAt' => $usuarioModel->usua_email_verified_at
        ];
    }

    protected function tratarInput(array $input): array
    {
        return [
            'usua_login' => $input['login'],
            'usua_password' => Hash::make($input['password']),
            'cliente_id' => $input['clienteId']
        ];
    }
}
