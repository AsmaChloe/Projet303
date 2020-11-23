<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEpreuve extends Model
{
    use HasFactory;

    protected $table = 'type_epreuves';
    protected $primaryKey = 'idTypeEpreuve';

    protected $fillable = ['valeurType'];

    /**
     * Obtenir les epreuves ayant ce type
     */
    public function epreuves(){
        return $this->hasMany(Epreuve::class,'idTypeEpreuve');
    }
}
