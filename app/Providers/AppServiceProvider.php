<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! File::isFile(base_path(config('settings.entry_point')))) {
            exit(config('settings.entry_point').' not found');
        }

        $contents = File::get(base_path(config('settings.entry_point')));

        $matches = [];
        preg_match_all(
            '~\$([a-zA-Z_][a-zA-Z0-0_]*) *= *[\'"]([^\'"]*)[\'"]~',
            $contents,
            $matches
        );

        $vars = array_combine($matches[1], $matches[2]);

        if (array_key_exists('application_folder', $vars)) {
            config('settings.controllers_path', $vars["application_folder"].'/controllers/');
            config('settings.models_path', $vars["application_folder"].'/models/');
        } else {
            exit("'application' folder not found");
        }
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
