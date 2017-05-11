<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Member;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);

        $membersForCheckboxes = Member::getMembersForCheckboxes();
        view()->share('membersForCheckboxes', $membersForCheckboxes);

        $active = "";
        view()->share('active', $active);
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
