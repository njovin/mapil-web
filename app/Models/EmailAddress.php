<?php

namespace Mapil\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Mapil\Exceptions\SafeException;

class EmailAddress extends Model
{
    use SoftDeletes;

    protected $reserved_addresses = [
        "postmaster@email.mapil.co",
        "hostmaster@email.mapil.co",
        "webmaster@email.mapil.co",
        "admin@email.mapil.co",
        "administrator@email.mapil.co",
        "nathan@email.mapil.co",
        "njovin@email.mapil.co",
    ];
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public static function boot()
    {
        EmailAddress::creating(function ($model) {
            $model->email = strtolower($model->email);
            // check for dupes
            $conflict = EmailAddress::whereEmail($model->email)->first();
            if(in_array($model->email, $model->reserved_addresses) || $conflict) {
                throw new SafeException("The email address "  . $model->email . " is already in use");
            }
        });
    }

    protected $rules = array(
        'email' => ['email',"required","regex:/[a-zA-Z0-9_]*@email.mapil.co/"],
        'user_id' => ['integer']
    );
    protected $messages = [
        'email.regex' => "Email address must end in email.mapil.co"
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
