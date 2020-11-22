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

    /**
     * Liste des ecs du groupe
     */
    public function ecs(){
        return $this->belongsToMany(EC::class,'groupe_ecs','idGroupe','idEC');
    }

    /**
     * Liste des enseignants du groupe
     */
    public function enseignant(){
        return $this->belongsToMany(User::class,'groupe_enseignants','idGroupe','idEnseignant');
    }

    /**
     * Liste des etudiants du groupe
     */
    public function etudiants(){
        return $this->belongsToMany(User::class,'groupe_etudiants','idGroupe','idEtudiant')->where('role',3);
    }

    /**
     * Obtenir les séances du groupe
     */
    public function seances() {
        return $this->hasMany(Seance::class);
    }

}
