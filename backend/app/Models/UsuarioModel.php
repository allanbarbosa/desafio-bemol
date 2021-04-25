<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioModel extends Model
{
    use HasFactory;
    
    protected $table = 'usuario';

    protected $primaryKey = 'usua_id';

    protected $fillable = [
        'usua_login', 'usua_password', 'cliente_id', 'usua_first_access'
    ];

    public function cliente()
    {
        return $this->belongsTo(ClienteModel::class, 'cliente_id');
    }
}
