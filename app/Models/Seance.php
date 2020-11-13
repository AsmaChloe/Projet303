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

    protected $fillable = ['debutSeance','finSeance','idUser','idGroupe','idEC'];

    public function enseignant(){
        return $this->belongsTo(User::class,'idUser');
    }

    public function groupe(){
        return $this->belongsTo(Groupes::class,'idGroupe');
    }

    public function EC(){
        return $this->belongsTo(EC::class,'idEC');
    }
}
