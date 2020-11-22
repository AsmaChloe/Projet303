<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentiel extends Model
{
    use HasFactory;

    protected $table = 'presentiels';
    protected $primaryKey = 'idPresentiel';

    protected $fillable = ['idSeance','idType','idEtudiant'];
}
