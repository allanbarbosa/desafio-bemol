<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\ChamadosModel;
use App\Repositories\ChamadosRepositorio;

class ChamadosServico
{
    protected $repositorio;

    public function __construct(ChamadosRepositorio $chamadosRepositorio)
    {
        $this->repositorio = $chamadosRepositorio;
    }

    public function save(array $input): array
    {
        $dados = $this->tratarInput($input);

        $chamado = $this->repositorio->save($dados);

        return $this->tratarOutput($chamado);
    }

    public function find(int $id): array
    {
        $chamado = $this->repositorio->find($id);

        return $this->tratarOutput($chamado);
    }

    public function get(array $filtro): array
    {
        $filtro = $this->tratarFiltro($filtro);

        $chamados = $this->repositorio->getWhere($filtro);

        return array_map(array($this, 'tratarOutput'), $chamados->all());
    }

    protected function tratarFiltro(array $filtro): array
    {
        $filtroTratado = [];

        if (isset($filtro['clienteId'])) {
            $filtroTratado['cliente_id'] = $filtro['clienteId'];
        }

        return $filtroTratado;
    }

    protected function tratarOutput(ChamadosModel $chamadosModel): array
    {
        return [
            'id' => $chamadosModel->cham_id,
            'titulo' => $chamadosModel->cham_titulo,
            'texto' => $chamadosModel->cham_texto,
            'criadoEm' => implode('/', array_reverse(explode('-', $chamadosModel->cham_criado_em))),
            'canalCriado' => $chamadosModel->cham_canal_criado,
            'clienteId' => $chamadosModel->cliente_id,
        ];
    }

    protected function tratarInput($input): array
    {
        return [
            'cham_titulo' => $input['titulo'],
            'cham_texto' => $input['texto'],
            'cham_criado_em' => implode('-', array_reverse(explode('/', $input['criadoEm']))),
            'cham_canal_criado' => $input['canalCriado'],
            'cliente_id' => $input['clienteId']
        ];
    }
}
