<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use JanisKelemen\Setting\Facades\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        view()->composer('partials.home-left-advance-search-bar', function ($view) {
////            die('view');
////            view()->share('gci', array('a','b','c'));
//        });
        $db_settings = Setting::all(['site_settings'])->transform(function ($setting) {
            return json_decode($setting, true);
        })->toArray();
        $db_settings = isset($db_settings['site_settings'])?$db_settings['site_settings']:[];
        $app_config = config('app');

        config([
            'app' => array_merge($app_config, $db_settings)
        ]);
//        dd($db_settings);
//        dd(config('app'));
        Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate');
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
