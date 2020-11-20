<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Obtenir le(s) diplome(s) que dirige le responsable 
     */
    public function diplomes(){
        return $this->belongsToMany(Diplomes::class);
    }

    /**
     * Obtenir le(s) parcour(s) que dirige le responsable user->parcours()
     */
    public function parcours(){
        return $this->hasManyThrough(Parcours::class,diplome_responsable::class,'idResponsable','idDiplome','id','idResponsable');//Has many parcours / pivot / id actuel via pivot / id du duo via le 3e / id actuel / id actuel du pivot
    }

    /**
     * Obtenir la liste des EC enseignés par cet enseignant
     */
    public function ecs(){
        return $this->belongsToMany(EC::class,'Ec_Enseignant');
    }

    /**
     * Obtenir la liste des EC où on l'étudiant s'est inscrit
     */
    public function ip(){
        return $this->belongsToMany(EC::class,'IP');
    }

    /**
     * Obtenir le(s) epreuves(s) de l'étudiant user->epreuves()
     */
    public function epreuves(){
        return $this->hasManyThrough(Epreuve::class,ip::class,'idEtudiant','idEC','id','idEtudiant');//Has many parcours / pivot / id actuel via pivot / id du duo via le 3e / id actuel / id actuel du pivot
    }

    /**
     * Obtenir le(s) seance(s) de l'enseignant user->seancesEns()
     */
    public function seancesEns(){
        return $this->hasManyThrough(Seance::class,Groupe_Enseignants::class,'idEnseignant','idGroupe','id','idEnseignant');//Has many parcours / pivot / id actuel via pivot / id du duo via le 3e / id actuel / id actuel du pivot
    }

    /**
     * Obtenir le(s) seance(s) de l'etudiant user->seancesEtu()
     */
    public function seancesEtu(){
        return $this->hasManyThrough(Seance::class,Groupe_Etudiant::class,'idEtudiant','idGroupe','id','idEtudiant');//Has many parcours / pivot / id actuel via pivot / id du duo via le 3e / id actuel / id actuel du pivot
    }

    /**
     * Obtenir les groupes de l'étudiant
     */
    public function groupesEtu(){
        return $this->belongsToMany(Groupe::class,'groupe_etudiants');
    }

    /**
     * Obtenir les groupes de l'enseignant
     */
    public function groupesEns(){
        return $this->belongsToMany(Groupe::class,'groupe_enseignants');
    }





    
    /*
     
    public function groupesEtu(){
        return $this->belongsToMany(Groupes::class,'groupe_etudiants','idUser','idGroupe');
    }


    public function groupesEns(){
        return $this->belongsToMany(Groupes::class,'groupe_enseignants','idUser','idGroupe');
    }*/

    public function presentiels() {
        return $this->hasMany(Presentiel::class);
    }

    public function seances() {
        return $this->hasMany(Seance::class);
    }

    

}
