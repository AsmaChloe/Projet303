<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EC extends Model
{

    use HasFactory;

    protected $table = 'e_c_s';
    protected $primaryKey = 'idEc';

    protected $fillable = ['nomEC','sigleEC','Nbpoints','idSemestre'];

    /**
     * Obtenir le semestre qui a l'ec
     */
    public function semestre(){
        return $this->belongsTo(Semestre::class,'idSemestre');
    }

    /**
     * Obtenir les parcours contenant l'ec // ec->parcours()
     */
    public function parcours(){
        return $this->semestre->parcours;
    }
    
     /**
     * Liste des etudiants inscrit à l'EC MARCHE PAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAS
     */
    public function ecEtudiant(){
        return $this->belongsToMany(User::class,IP::class,'idEC','idEtudiant');
    }


    /**
     * Liste des enseignants qui enseignent cet EC NE RETOURNE RIEN CA NE MARCHE PAS
     */
    public function enseignants(){
        return $this->belongsToMany(User::class,'ec_enseignants','idEnseignant');
    }

   

    /**
     * Obtenir les groupes suivant l'ec // NE MARCHE PAS PAS PAS PAS 
     */
    public function groupes(){
        return $this->belongsToMany(Groupes::class,'groupe_ecs', 'idEC', 'idGroupe');
    }

    /**
     * Obtenir les épreuves de l'EC marche pas
     */
    public function epreuves(){
        return $this->hasMany(Epreuve::class,'idEC','idEC');
    }

    /**
     * Obtenir le(s) seance(s) de l'ec user->seances() ça marche
     */
    public function seances(){
        return $this->hasManyThrough(Seance::class,Groupe_EC::class,'idEC','idGroupe','idEC','idEC');//Has many parcours / pivot / id actuel via pivot / id du duo via le 3e / id actuel / id actuel du pivot
    }

    
}
