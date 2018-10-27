<?php

namespace App\Providers;

use Darryldecode\Cart\Cart;
use Illuminate\Support\ServiceProvider;

class PengadaanBerasProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->singleton('pengadaanBeras', function($app)
      {
          $storage = $app['session'];
          $events = $app['events'];
          $instanceName = 'pengadaanBeras';
          $session_key = 'AsASDMCks0ks1';
          return new Cart(
              $storage,
              $events,
              $instanceName,
              $session_key,
              config('shopping_cart')
          );
      });
    }
}
