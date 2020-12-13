<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EC extends Model
{
    use HasFactory;

    protected $table = 'e_c_s';
    protected $primaryKey = 'idEC';

    protected $fillable = ['nomEC','sigleEC','Nbpoints','idSemestre','nbECTS'];

    /**
     * Obtenir le semestre qui a l'EC
     */
    public function semestre(){
        return $this->belongsTo(Semestre::class,'idSemestre');
    }

    /**
     * Obtenir les parcours contenant l'ec // ec->parcours()
     */
    public function parcours(){
        return $this->belongsToMany(Parcours::class,'parcours_ec','idEC','idParcours');
    }

    /**
     * Obtenir les epreuves de l'EC
     */
    public function epreuves(){
        return $this->hasMany(Epreuve::class,'idEC');
    }

    /**
     * Liste des groupes de l'EC 
     */
    public function ec_groupe(){ 
        return $this->belongsToMany(Groupes::class,'ec_groupe','idEC','idGroupe');
    }

    /**
     * Liste de(s) l'enseignant(s) d'un EC
     */
    public function enseignants(){
        return $this->belongsToMany(User::class,'ec_enseignant','idEC','idEnseignant');
    }
    
     /**
     * Liste des etudiants inscrit à l'EC
     */
    public function etudiants(){
        return $this->belongsToMany(User::class,'i_p_s','idEC','idEtudiant');
    }
    

     /**
     * Obtenir la liste des EC où on l'étudiant s'est inscrit
     */
    public function ip(){
        return $this->belongsToMany(EC::class,IP::class,'idEtudiant','idEC');
    }

    /**
     * Les notes des élèves dans l'EC
     */
    public function notes(){
        return $this->hasManyThrough(Notes::class,IP::class,'idEC','idEtudiant','idEC','idEtudiant');
        
    }

    /**
     * Les seances de l'EC
     */
    public function seances(){
        return $this->hasMany(Seance::class,'idEC');
        
    }
    
}
