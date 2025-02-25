<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contrato extends Model
{
    use Notifiable, HasFactory;

    protected $table = 'contratos';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['idCliente', 'descripcion'];
    protected $hidden = ['created_at', 'updated_at'];
}
