<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Groupe_Enseignants extends Pivot
{
    use HasFactory;

    protected $table = 'groupe_enseignants';
    protected $primaryKey = 'idGroupeEns';

    protected $fillable = ['idEnseignant','idGroupe'];
}
