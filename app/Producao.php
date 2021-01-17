<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producao extends Model
{
    protected $table = "producao";

    protected $fillable = [
        'foto_producao', 'lote', 'nome_producao', 'nome_produtor', 'data_producao', 'og_producao', 'acompanhamento', 'maturacao', 'data_envase'
    ];
}
