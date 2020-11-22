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
        return $this->belongsToMany(Diplomes::class,'Diplome_Responsables','idResponsable','idDiplome');
    }

    /**
     * Obtenir le(s) parcour(s) que dirige le responsable user->parcours()
     */
    public function parcours(){
        return $this->hasManyThrough(Parcours::class,diplome_responsable::class,'idResponsable','idDiplome','id','idResponsable');
    }

    /**
     * Obtenir les EC d'un enseignant
     */
    public function ec_enseignant(){
        return $this->belongsToMany(EC::class,'EC_Enseignant','idEnseignant','idEC');
    }

    /**
     * Obtenir la liste des EC où on l'étudiant s'est inscrit
     */
    public function ip(){
        return $this->belongsToMany(EC::class,IP::class,'idEtudiant','idEC');
    }

    /**
     * Obtenir la liste des groupes de l'enseignant 
     */
    public function groupesEns(){
        return $this->belongsToMany(Groupes::class,'enseignant_groupe','idEnseignant','idGroupe');
    }

     /**
     * Obtenir les groupes de l'étudiant
     */
    public function groupesEtu(){
        return $this->belongsToMany(Groupes::class,'groupe_etudiants','idEtudiant','idGroupe');
    }

    /**
     * Obtenir les notes de l'étudiant
     */
    public function notes(){
        return $this->hasMany(Notes::class,'idEtudiant');
    }


    /**
     * Obtenir le(s) epreuves(s) de l'étudiant user->epreuves()
     */
    public function epreuves(){
        return $this->hasManyThrough(Epreuve::class,IP::class,'idEtudiant','idEC','id','idEC');//Has many parcours / pivot / id actuel via pivot / id du duo via le 3e / id actuel / id duo dans pivot
    }

    /**
     * Obtenir le(s) seance(s) de l'etudiant user->seancesEtu()
     */
    public function seancesEtu(){
        return $this->hasManyThrough(Seance::class,Groupe_Etudiants::class,'idEtudiant','idGroupe','id','idGroupe');//Has many parcours / pivot / id actuel via pivot / id du duo via le 3e / id actuel / id duo du pivot
    }

    /**
     * Obtenir le(s) seance(s) de l'enseignant user->seancesEns()
     */
    public function seancesEns(){
        return $this->hasManyThrough(Seance::class,Enseignant_Groupe::class,'idEnseignant','idGroupe','id','idGroupe');//Has many parcours / pivot / id actuel via pivot / id du duo via le 3e / id actuel / id duo du pivot
    }

}
