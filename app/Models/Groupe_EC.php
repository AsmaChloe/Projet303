<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe_EC extends Model
{
    use HasFactory;

    protected $table = 'groupe_ecs';
    protected $primaryKey = 'idGroupeEC';

    protected $fillable = ['idEC','idGroupe'];
}
