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
        return $this->belongsTo(Diplomes::class,'idDiplome');
    }

    /**
     * Obtenir le(s) parcour(s) que dirige le responsable // $parcours->responsables()
     */
    public function responsables(){
        return $this->diplome->responsables;
    }

    /**
     * Obtenir les semestres du parcours
     */
    public function semestres(){
        return $this->belongsToMany(Semestre::class,'parcours_semestres','idParcours','idSemestre');
    }

    /**
     * Obtenir les étudiants du parcours
     */
    public function etudiants(){
        return $this->belongsToMany(User::class,'etudiant_parcours','idParcours','idEtudiant');
    }

    /**
     * Obtenir le(s) ec(s) du parcours user->ecs()
     */
    public function ecs(){
        return $this->belongsToMany(EC::class,'parcours_ec','idParcours','idEC');

    }

}
