<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class diplome_responsable extends Pivot
{
    use HasFactory;

    protected $table = 'diplome_responsables';
    /*protected $primaryKey = 'idDiplomeResponsable';

    protected $fillable = ['idDiplome','idResponsable'];*/
}
