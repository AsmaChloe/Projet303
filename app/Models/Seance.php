<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use \App\Models\User;
use \App\Models\Groupes;
use \App\Models\EC;

class Seance extends Model
{
    use HasFactory;

    protected $table = 'seances';
    protected $primaryKey = 'idSeance';

    protected $fillable = ['debutSeance','finSeance','idGroupe'];

    /**
     * Obtenir le groupe qui a assité à la séance
     */
    public function groupe(){
        return $this->belongsTo(Groupes::class,'idSeance');
    }

    /**
     * Obtenir l'enseignant de la séance : 
     */
    public function enseignant(){
        return $this->groupe->enseignant;
    }

    /**
     * Obtenir les etudiants de la séance : 
     */
    public function etudiants(){
        return $this->groupe->etudiants;
    }

    /**
     * Obtenir l'EC de la séance
     */
    public function ec(){
        return $this->groupe->ec_groupe;
    }

    /**
     * Obtenir les presentiels de la séance
     */
    public function presentiels(){
        return $this->hasMany(Presentiel::class,'idSeance');
    }

}
