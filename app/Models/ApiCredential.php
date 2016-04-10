<?php

namespace Mapil\Models;

class ApiCredential extends Model
{
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
