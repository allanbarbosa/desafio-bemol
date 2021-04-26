<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ClienteServico;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClienteController extends Controller
{
    protected $servico;

    public function __construct(ClienteServico $clienteServico)
    {
        $this->servico = $clienteServico;
    }

    public function index(int $id)
    {
        try {
            $cliente = $this->servico->find($id);

            return response()->json($cliente, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'mensagem' => 'Cliente não encontrado.',
                'code' => '1000'
            ], 404);
        }
    }

    public function store()
    {
        $input = request()->all();

        $cliente = $this->servico->save($input);

        return response()->json($cliente, 200);
    }

    public function update(int $id)
    {
        try {
            $input = request()->all();

            $cliente = $this->servico->update($id, $input);

            return response()->json($cliente, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'mensagem' => 'Cliente não encontrado.',
                'code' => '1000'
            ], 404);
        }
    }
}
