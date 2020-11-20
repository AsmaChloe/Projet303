<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ec_Enseignant extends Model
{
    use HasFactory;

    protected $table = 'ec_enseignants';
    protected $primaryKey = 'idECEnseignant';

    protected $fillable = ['idEC','idEnseignant'];
}
