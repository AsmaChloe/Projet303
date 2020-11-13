<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EC extends Model
{
    use HasFactory;

    protected $table = 'e_c_s';
    protected $primaryKey = 'idEc';

    protected $fillable = ['intituleEC','Nbpoints'];

    public function notes() {
        return $this->hasMany(Notes::class);
    }       

    public function groupes(){ //Obtenir les groupes de l'ec
        return $this->belongsToMany('App\Models\Groupes','groupe_ecs', 'idEC', 'idGroupe');
    }

    public function presentiels() {
        return $this->hasMany(Presentiel::class);
    }

    public function seances() {
        return $this->hasMany(Seance::class);
    }

}
