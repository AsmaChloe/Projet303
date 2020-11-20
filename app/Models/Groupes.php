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
     * Liste des enseignants du groupe
     */
    public function enseignant(){
        return $this->belongsToMany(User::class,'groupe_enseignants')->where('role',2)->get();
    }

    /**
     * Liste des ecs du groupe
     */
    public function ecs(){
        return $this->belongsToMany(EC::class,'groupe_ecs');
    }

    /**
     * Liste des etudiants du groupe
     */
    public function etudiants(){
        return $this->belongsToMany(User::class,'groupe_etudiants')->where('role',3)->get();
    }

    /**
     * Obtenir les séances du groupe
     */
    public function seances() {
        return $this->hasMany(Seance::class);
    }

}
