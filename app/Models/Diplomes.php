<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diplomes extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'diplomes';
    protected $primaryKey = 'idDiplome';

    protected $fillable = ['nomDiplome','typeDiplome','sigleDiplome'];

    /**
     * Obtenir le(s) responsable(s) du diplome
     */
    public function responsables(){
        return $this->belongsToMany(User::class,'diplome_responsables','idDiplome','idResponsable');
    }
    
    /**
     * Obtenir les parcours du diplomes
     */
    public function parcours(){
        return $this->hasMany(Parcours::class,'idDiplome','idDiplome');
    }

}
