<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tarefa;

class TarefaProblema extends Model
{
    protected $table = 'problema_tarefa';
    use HasFactory;


    public function tarefa()
    {
        return $this->belongsTo(Tarefa::class, 'tarefa_id');
    }
    
}
