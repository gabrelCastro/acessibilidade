<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demandas extends Model
{
    use HasFactory;

    
    protected $table = 'avaliacao';
    
    public function erros(){
        return $this->hasMany(Erro::class);
    }
}
