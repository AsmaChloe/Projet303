<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePresentiel extends Model
{
    use HasFactory;

    protected $table = 'type_presentiels';
    protected $primaryKey = 'idType';

    protected $fillable = ['valeurType'];
}
