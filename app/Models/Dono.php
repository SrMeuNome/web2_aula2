<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dono extends Model
{
    use HasFactory;
    protected $table = "dono";

    public function listaAnimais()
    {
        return $this->belongsToMany("App\Models\Animal", "dono_animal", "id_dono", "id_animal");
    }
}
