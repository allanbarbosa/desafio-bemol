<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\UsuarioModel;

class UsuarioRepositorio
{
    public function save(array $input): UsuarioModel
    {
        return UsuarioModel::create($input);
    }

    public function find(int $id): UsuarioModel
    {
        return UsuarioModel::findOrFail($id);
    }
}
