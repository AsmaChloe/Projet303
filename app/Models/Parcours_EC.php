<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcours_EC extends Model
{
    use HasFactory;

    protected $table = 'parcours_ec';
    protected $primaryKey = 'idParcoursEC';

    protected $fillable = ['idParcours','idEC'];
}
