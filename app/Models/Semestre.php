<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    use HasFactory;

    protected $table = 'semestre';
    protected $primaryKey = 'idSemestre';

    /**
     * Obtenir les parcours ayant ce semestre
     */
    public function parcours(){
        return $this->belongsToMany(Semestre::class);
    }
    
    /**
     * Obtenir les EC du semestre
     */
    public function ecs(){
        return $this->hasMany(EC::class);
    }

    
}
