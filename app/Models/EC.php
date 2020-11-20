<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EC extends Model
{
    //Remarque : Comment différentier enseignants() et etudiants() ??
    use HasFactory;

    protected $table = 'e_c_s';
    protected $primaryKey = 'idEc';

    protected $fillable = ['nomEC','sigleEC','Nbpoints','idSemestre'];

    /**
     * Obtenir le semestre qui a l'ec
     */
    public function semestre(){
        return $this->belongsTo(Semestre::class);
    }

    /**
     * Liste des enseignants qui enseignent cet EC
     */
    public function enseignants(){
        return $this->belongsToMany(User::class);
    }

    /**
     * Liste des etudiants inscrit à l'EC
     */
    public function etudiants(){
        return $this->belongsToMany(User::class);
    }

    /**
     * Obtenir les épreuves de l'EC
     */
    public function epreuves(){
        return $this->hasMany();
    }

    /**
     * Obtenir le(s) seance(s) de l'ec user->seances()
     */
    public function seances(){
        return $this->hasManyThrough(Seance::class,Groupe_EC::class,'idEC','idGroupe','idEC','idEC');//Has many parcours / pivot / id actuel via pivot / id du duo via le 3e / id actuel / id actuel du pivot
    }
}
