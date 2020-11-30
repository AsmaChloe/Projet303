<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notes extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'notes';
    protected $primaryKey = 'idNote';

    protected $fillable = ['valeurNote','maxNote','idEtudiant','idEpreuve'];

    /**
     * Obtenir l'etudiant ayant la note
     */
    public function etudiant()
    {
        return $this->belongsTo(User::class,'idNote');
    }

    /**
     * Obtenir l'épreuve correspondante
     */
    public function epreuve() 
    {
        return $this->belongsTo(Epreuve::class,'idNote');
    }

}
