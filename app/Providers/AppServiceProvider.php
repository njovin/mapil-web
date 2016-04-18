<?php

namespace Mapil\Providers;

use Illuminate\Support\ServiceProvider;
use Mapil\Models\User;
use Mapil\Models\ApiCredential;
use Mapil\Models\EmailAddress;
use Webpatser\Uuid\Uuid;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::creating(function ($user) {
            $user->uuid = Uuid::generate();
        });
        User::created(function ($user) {
            // create API credentials
            $api = new ApiCredential();
            $api->uuid = Uuid::generate();
            $api->token = md5(uniqid(rand(), true));
            $api->secret = md5(uniqid(rand(), true));
            $api->user_id = $user->id;
            $api->save();

            // create an email address
            $x = array_rand(getEmotions());
            $y = array_rand(getColorNames());
            $z = array_rand(getAnimals());

            $email = new EmailAddress();
            $email->email = getEmotions()[$x] . getColorNames()[$y] . getAnimals()[$z] . "@mail.mapil.co";
            $email->user_id = $user->id;
            $email->save();            
        });        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
