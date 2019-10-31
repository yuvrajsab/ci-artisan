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
        if (! File::isFile(config('settings.entry_point'))) {
            exit(config('settings.entry_point').' not found');
        }

        $contents = File::get(config('settings.entry_point'));

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
            config('settings.migrations_path', $vars["application_folder"].'/migrations/');
            config('settings.tests_path', $vars["application_folder"].'/controllers/tests/');
            config('settings.third_party_path', $vars["application_folder"].'/third_party/');
            config('settings.config_path', $vars["application_folder"].'/config/');
        } else {
            exit("'application' folder not found");
        }

        if (array_key_exists('view_folder', $vars)) {
            if (! empty($vars["view_folder"])) {
                config('settings.views_path', $vars["view_folder"]);
            }
        } else {
            exit("'views' folder not found");
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
