<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcoursSemestre extends Model
{
    use HasFactory;

    protected $table = 'parcours_semestres';
    protected $primaryKey = 'idParcoursSemestre';

    protected $fillable = ['idParcours','idSemestre'];
}
