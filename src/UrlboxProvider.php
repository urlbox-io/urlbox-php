<?php

namespace Urlbox\Screenshots;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;

class UrlboxProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton( Urlbox::class, function( $app ) {
            $key    = config( 'services.urlbox.key' );
            $secret = config( 'services.urlbox.secret' );

            if ( ! $key || ! $secret ) {
                throw new InvalidArgumentException( 'Please ensure you have set values for `services.urlbox.key` and `services.urlbox.secret`' );
            }

            return new Urlbox( $key, $secret, $app->make(Client::class));
        });

        $this->app->alias( Urlbox::class, 'urlbox' );
    }
}