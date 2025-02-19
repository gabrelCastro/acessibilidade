<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problema extends Model
{
    use HasFactory;

    protected $table = 'problemas'; //Definindo o nome da tabela, pois o nome dela não segue o padrão do laravel

    public function tarefas()
    {
        return $this->belongsToMany(Tarefa::class, 'problema_tarefa', 'problema_id', 'tarefa_id');
    }
}
