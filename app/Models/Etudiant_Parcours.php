<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Etudiant_Parcours extends Pivot
{
    use HasFactory;
    protected $table = 'etudiant_parcours';
    protected $primaryKey = 'idEtudiantParcours';

    protected $fillable = ['idEtudiant','idParcours'];
}
