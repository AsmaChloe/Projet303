<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe_Etudiants extends Model
{
    use HasFactory;

    protected $table = 'groupe_etudiants';
    protected $primaryKey = 'idGroupeEtu';

    protected $fillable = ['idUser','idGroupe'];
}
