<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ChamadosServico;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ChamadoController extends Controller
{
    protected $servico;

    public function __construct(ChamadosServico $chamadosServico)
    {
        $this->servico = $chamadosServico;
    }

    public function index(int $idCliente)
    {
        $input = request()->all();
        $input['clienteId'] = $idCliente;

        $chamados = $this->servico->get($input);

        return response()->json($chamados, 200);
    }

    public function show(int $idCliente, int $id)
    {
        try {
            $chamado = $this->servico->find($id);

            return response()->json($chamado, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'mensagem' => 'Chamado não encontrado.',
                'code' => '1000'
            ], 404);
        }
    }

    public function store(int $idCliente, int $id)
    {
        $input = request()->all();
        $input['clienteId'] = $idCliente;

        $chamado = $this->servico->save($input);

        return response()->json($chamado, 200);
    }
}
