<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;

    protected $table = 'notes';
    protected $primaryKey = 'idNote';

    protected $fillable = ['valeurNote','maxNote','idUser','idEC'];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    
    public function ec() //obtenur ec du user en question ??
    {
        return $this->belongsTo(EC::class, 'idEC');
    }
}
