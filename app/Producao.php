<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producao extends Model
{
    protected $table = "producao";

    protected $fillable = [
        'foto_producao', 'nome_criador', 'nome_producao', 'data_producao', 'extra1', 'extra2'
    ];
}
