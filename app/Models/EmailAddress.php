<?php

namespace Mapil\Models;

class EmailAddress extends Model
{
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
