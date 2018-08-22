<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreated;
use App\Product;
use App\User;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        User::created(function($user){
          Mail::to($user)->send(new UserCreated($user));
        });

        Product::updated(function($product){
          if($product->quantity == 0 && $product->estaDisponible()){
            $product->status = Product::PRODUCTO_NO_DISPONIBLE;

            $product->save();
          }
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
