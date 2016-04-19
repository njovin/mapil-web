<?php

namespace Mapil\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getEmailAddressLimit()
    {
        return 20;
    }
    public function email_addresses() 
    {
        return $this->hasMany(EmailAddress::class);
    }
    public function api_credentials() 
    {
        return $this->hasMany(ApiCredential::class);
    }    
}
