<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Enseignant_Groupe extends Pivot
{
    use HasFactory;

    protected $table = 'enseignant_groupe';
    protected $primaryKey = 'idEnseignantGroupe';

    protected $fillable = ['idEnseignant','idGroupe'];
}
