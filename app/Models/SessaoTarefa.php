<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tarefa;

class SessaoTarefa extends Model
{
    protected $table = 'avaliacaotarefa';
    use HasFactory;


    public function tarefa()
    {
        return $this->belongsTo(Tarefa::class, 'tarefa_id');
    }
    
}
