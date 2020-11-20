<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcours extends Model
{
    use HasFactory;

    protected $table = 'parcours';
    protected $primaryKey = 'idParcours';

    protected $fillable = ['nomParcours','sigleParcours','idDiplome'];

    /**
     * Obtenir le diplome du parcours
     */
    public function diplome(){
        return $this->belongsTo(Diplomes::class);
    }

    /**
     * Obtenir le(s) parcour(s) que dirige le responsable // avec ou sans () ???
     */
    public function parcours(){
        return $this->diplome->responsables;
    }

    /**
     * Obtenir les semestres du parcours
     */
    public function semestres(){
        return $this->belongsToMany(Semestre::class,'ParcoursSemestre');
    }

}
