<?php

return [

    'controllers_path' => env('CONTROLLERS_PATH', 'application/controllers/'),
    'models_path' => env('MODELS_PATH', 'application/models/'),

    'base_controller' => env('BASE_CONTROLLER', 'CI_Controller'),
    'base_model' => env('BASE_MODEL', 'CI_Model'),
    
    'entry_point' => env('ENTRY_POINT', 'index.php'),
];
