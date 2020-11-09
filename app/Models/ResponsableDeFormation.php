<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsableDeFormation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'prenomResponsable', 'nomResponsable','DateNaissanceResp'
    ];
}
