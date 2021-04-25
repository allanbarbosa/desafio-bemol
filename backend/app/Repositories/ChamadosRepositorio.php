<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\ChamadosModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ChamadosRepositorio
{
    public function save(array $input): ChamadosModel
    {
        return ChamadosModel::create($input);
    }

    public function find(int $id): ChamadosModel
    {
        return ChamadosModel::findOrFail($id);
    }

    public function getWhere(array $input): Collection
    {
        $chamados = ChamadosModel::orderBy('cham_id', 'DESC');

        if (isset($input['cliente_id'])) {
            $chamados = $chamados->where('cliente_id', '=', $input['cliente_id']);
        }

        if (isset($input['cham_canal_criado'])) {
            $chamados = $chamados->where('cham_canal_criado', '=', $input['cham_canal_criado']);
        }

        return $chamados->get();
    }
}
