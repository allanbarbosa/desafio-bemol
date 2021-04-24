<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChamadosModel extends Model
{
    use HasFactory;

    protected $table = 'chamados';

    protected $primaryKey = 'cham_id';

    protected $fillable = [
        'cliente_id', 'cham_titulo', 'cham_texto', 'cham_criado_em',
        'cham_canal_criado'
    ];

    public function cliente()
    {
        return $this->belongsTo(ClienteModel::class, 'cliente_id');
    }
}
