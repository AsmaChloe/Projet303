<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class IP extends Pivot
{
    use HasFactory;
    protected $table = 'i_p_s';
    protected $primaryKey = 'idIP';

    protected $fillable = ['idEC','idEtudiant'];
}
?>
