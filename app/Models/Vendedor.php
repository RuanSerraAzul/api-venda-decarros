<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Vendedor extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'vendedores';

    public $timestamps = false;

    protected $hidden = array('password');

    protected $fillable = [
        'nome',
        'email',
        'password',
    ];


   
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}