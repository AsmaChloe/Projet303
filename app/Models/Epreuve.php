<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epreuve extends Model
{
    use HasFactory;

    
    protected $table = 'epreuves';
    protected $primaryKey = 'idEpreuve';

    protected $fillable = ['dateEpreuve','dureeEpreuve','numSession','pourcentage','idEC','idTypeEpreuve'];

    /**
     * Obtenir l'ec de l'épreuve
     */
    public function ec(){
        return $this->belongsTo(EC::class,'idEC');
    }

    /**
     * Obtenir les étudiants participant à l'épreuve 
     */
    public function etudiants(){
        return $this->ec->etudiants;
    }

    /**
     * Obtenir les notes de l'épreuve
     */
    public function notes(){
        return $this->hasMany(Notes::class,'idEpreuve');
    }

    /**
     * Obtenir le type de l'épreuve
     */
    public function type(){
        return $this->belongsTo(TypeEpreuve::class,'idTypeEpreuve');
    }

}
