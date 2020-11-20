<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Groupe_EC extends Pivot
{
    use HasFactory;

    protected $table = 'groupe_ecs';
    protected $primaryKey = 'idGroupeEC';

    protected $fillable = ['idEC','idGroupe'];
}
