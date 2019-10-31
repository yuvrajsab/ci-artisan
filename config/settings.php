<?php

return [
    'config_path' => 'application/config/',
    'controllers_path' => 'application/controllers/',
    'models_path' => 'application/models/',
    'migrations_path' => 'application/migrations/',
    'tests_path' => 'application/controllers/tests/',
    'third_party_path' => 'application/third_party/',
    'views_path' => 'application/views/',
    'entry_point' => env('CI_ARTISAN_ENTRY_POINT', 'index.php'),
];
