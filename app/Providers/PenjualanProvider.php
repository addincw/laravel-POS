<?php

namespace App\Providers;

use Darryldecode\Cart\Cart;
use Illuminate\Support\ServiceProvider;

class PenjualanProvider extends ServiceProvider
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
      $this->app->singleton('penjualan', function($app)
      {
          $storage = $app['session'];
          $events = $app['events'];
          $instanceName = 'penjualan';
          $session_key = '88uuiioo99888';
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
