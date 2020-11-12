<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe_Enseignants extends Model
{
    use HasFactory;

    protected $table = 'groupe_enseignants';
    protected $primaryKey = 'idGroupeEns';

    protected $fillable = ['idUser','idGroupe'];
}
