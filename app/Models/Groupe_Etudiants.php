<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Groupe_Etudiants extends Pivot
{
    use HasFactory;

    protected $table = 'groupe_etudiants';
    protected $primaryKey = 'idGroupeEtu';

    protected $fillable = ['idEtudiant','idGroupe'];
}
