<?php

namespace App\Providers;

class DropboxServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Storage::extend( 'dropbox', function( Application $app, array $config )
        {
            $resource = ( new Client() )->post( $config[ 'token_url' ] , [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $config[ 'refresh_token' ]
                ]
            ]);

            $accessToken = json_decode( $resource->getBody(), true )[ 'access_token' ];

            $adapter = new DropboxAdapter( new DropboxClient( $accessToken ) );

            return new FilesystemAdapter( new Filesystem( $adapter, $config ), $adapter, $config );
        });
    }
}
