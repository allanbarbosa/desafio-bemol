<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\ClienteModel;
use Illuminate\Database\Eloquent\Model;

class ClienteRepositorio
{
    public function save(array $input): Model
    {
        return ClienteModel::create($input);
    }

    public function find(int $id): Model
    {
        return ClienteModel::findOrFail($id);
    }

    public function update(int $id, array $input): Model
    {
        $cliente = $this->find($id);

        $cliente->update($input);

        return $cliente;
    }
}
