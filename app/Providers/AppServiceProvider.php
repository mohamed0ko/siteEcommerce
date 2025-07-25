<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Nette\Utils\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        View::composer('*', function ($view) {
            $cartCount = 0;

            if (Auth::check()) {
                $cartCount = Cart::where('user_id', Auth::id())->sum('quantityCart');
            }

            $view->with('cartCount', $cartCount);
        });
        View::composer('*', function ($view) {
            $favoriteCount = 0;

            if (Auth::check()) {
                $favoriteCount = Auth::user()->favorites()->count();
            }

            $view->with('favoriteCount', $favoriteCount);
        });
    }
}
