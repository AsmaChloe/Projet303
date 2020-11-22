<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EC_Enseignant extends Pivot
{
    use HasFactory;

    use HasFactory;
    protected $table = 'ec_enseignant';
    protected $primaryKey = 'idECEnseignant';

    protected $fillable = ['idEC','idEnseignant'];
}
