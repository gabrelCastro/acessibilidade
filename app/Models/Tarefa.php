<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SessaoTarefa;

class Tarefa extends Model
{
    protected $table = 'tarefa';
    use HasFactory;


    public function avaliacoes()
    {
        return $this->hasMany(SessaoTarefa::class, 'tarefa_id');
    }
}