<?php

namespace Mapil\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Mapil\Exceptions\SafeException;
use Webpatser\Uuid\Uuid;

class EmailAddress extends Model
{
    use SoftDeletes;

    protected $reserved_addresses = [
        "postmaster@mail.mapil.co",
        "hostmaster@mail.mapil.co",
        "webmaster@mail.mapil.co",
        "admin@mail.mapil.co",
        "administrator@mail.mapil.co",
        "nathan@mail.mapil.co",
        "njovin@mail.mapil.co",
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
            $model->uuid = Uuid::generate();
            // check for dupes
            $conflict = EmailAddress::whereEmail($model->email)->first();
            if(in_array($model->email, $model->reserved_addresses) || $conflict) {
                throw new SafeException("The email address "  . $model->email . " is already in use");
            }
        });
    }

    protected $rules = array(
        'email' => ['email',"required","regex:/[a-zA-Z0-9_]*@mail.mapil.co/"],
        'user_id' => ['integer']
    );
    protected $messages = [
        'email.regex' => "Email address must end in mail.mapil.co"
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
