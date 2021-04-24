<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteModel extends Model
{
    use HasFactory;

    protected $table = 'cliente';
    
    protected $primaryKey = 'clie_id';

    protected $fillable = [
        'clie_nome_completo', 'clie_cpf', 'clie_email', 'clie_data_nascimento',
        'clie_celular', 'clie_cep', 'clie_endereco', 'clie_complemento',
        'clie_bairro', 'clie_municipio', 'clie_estado'
    ];

    public function usuario()
    {
        return $this->hasOne(UsuarioModel::class, 'cliente_id');
    }

    public function chamado()
    {
        return $this->hasMany(ChamadosModel::class, 'cliente_id');
    }
}
