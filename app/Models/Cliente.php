<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use Notifiable, HasFactory;

    protected $table = 'clientes';    
    protected $fillable = ['dni', 'nombre', 'apellido1', 'apellido2', 'direccion', 'email', 'fechaNacimiento', 'contrasenna'];
    protected $hidden = ['id', 'contrasenna', 'created_at', 'updated_at'];



    public function contratos(): HasMany
    {
        return $this->hasMany(Contrato::class, 'idCliente');
    }
}
