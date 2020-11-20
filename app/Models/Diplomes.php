<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $table = 'diplomes';
    protected $primaryKey = 'idDiplome';

    protected $fillable = ['nomDiplome','typeDiplome','sigleDiplome'];

    /**
     * Obtenir le(s) responsable(s) du diplome
     */
    public function responsables(){
        return $this->belongsToMany(User::class);
    }
    
    /**
     * Obtenir les parcours du diplomes
     */
    public function parcours(){
        return $this->hasMany(Parcours::class);
    }

}
