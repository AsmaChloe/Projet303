<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupes extends Model
{
    use HasFactory;

    
    protected $table = 'groupes';
    protected $primaryKey = 'idGroupe';

    protected $fillable = ['nomGroupe','typeGroupe'];

    public function etudiants() { //Obtenir les etudiants du groupe
        return $this->belongsToMany('App\Models\User','groupe_etudiants', 'idGroupe', 'idEtudiant'); //Jointure sur les id
    }

    public function enseignants() { //Obtenir l'enseignant du groupe
        return $this->belongsToMany('App\Models\User','Groupe_Enseignants', 'idGroupe', 'idEnseignant'); //Jointure sur les id
    }

    public function ecs() { //Obtenir l'ec du groupe
        return $this->belongsToMany('App\Models\EC','groupe_ecs', 'idGroupe', 'idEC'); //Jointure sur les id
    }

    /**
     * Obtenir les séances du groupe
     */
    public function seances() {
        return $this->hasMany(Seance::class);
    }

}
