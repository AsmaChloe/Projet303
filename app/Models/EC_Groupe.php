<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EC_Groupe extends Pivot
{
    use HasFactory;

    protected $table = 'EC_Groupe';
    protected $primaryKey = 'idECGroupe';

    protected $fillable = ['idEC','idGroupe'];

}
