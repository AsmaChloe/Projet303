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
     * Liste des EC du groupe
     */
    public function ec_groupe(){
        return $this->belongsToMany(EC::class,'ec_groupe','idGroupe','idEC');
    }

    /**
     * Liste des enseignants du groupe
     */
    public function enseignants(){
        return $this->belongsToMany(User::class,'enseignant_groupe','idGroupe','idEnseignant');
    }

    /**
     * Liste des etudiants du groupe
     */
    public function etudiants(){
        return $this->belongsToMany(User::class,'groupe_etudiants','idGroupe','idEtudiant');
    }

    /**
     * Obtenir les séances du groupe
     */
    public function seances() {
        return $this->hasMany(Seance::class,'idGroupe');
    }

}
