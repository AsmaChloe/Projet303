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

    /**
     * Obtenir l'étudiant ayant ce presentiel
     */
    public function etudiant(){
        return $this->belongsTo(User::class,'idEtudiant');
    }

    /**
     * Obtenir le type du presentiel Abscent/Present/Distance
     */
    public function type(){
        return $this->belongsTo(TypePresentiel::class,'idType');
    }

    /**
     * Obtenir la séance qui correspond au présentiel
     */
    public function seance(){
        return $this->belongsTo(Seance::class,'idSeance');
    }

}
