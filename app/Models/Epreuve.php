<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epreuve extends Model
{
    use HasFactory;

    
    protected $table = 'epreuves';
    protected $primaryKey = 'idEpreuve';

    protected $fillable = ['dateEpreuve','dureeEpreuve','numSession','pourcentage','idEC'];

    /**
     * Obtenir les notes de l'épreuve
     */
    public function notes(){
        return $this->hasMany(Notes::class);
    }

    /**
     * Obtenir l'ec de l'épreuve
     */
    public function ec(){
        return $this->belongsTo(EC::class);
    }

    /**
     * Obtenir les étudiants participant à l'épreuve 
     */
    public function etudiant(){
        return $this->ec->etudiants;
    }
    
}
