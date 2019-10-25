<?php

namespace App\Commands\Make;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\File;
use LaravelZero\Framework\Commands\Command;

class Controller extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'make:controller 
                            {name : The name of the class}
                            {--extends= : The name of the base class.}
                            {--resource : Generate a resource controller class.}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create a new controller class';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $argv = explode('/', $this->argument('name'));
        $name = array_pop($argv);

        $path = config('settings.controllers_path');
        for ($i=0; $i < sizeof($argv); $i++) { 
            if (! File::exists($path.'/'.$argv[$i])) {
                File::makeDirectory($path.'/'.$argv[$i]);
            }
            $path .= '/'.$argv[$i];
        }
        
        $baseclass = $this->option('extends') ?? config('settings.base_controller');

        if ($this->option('resource')) {
            $content = <<<EOF
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class $name extends $baseclass {

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public function show()
    {
        //
    }

    public function edit()
    {
        //
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }
}
EOF;
        } else {
            $content = <<<EOF
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class $name extends $baseclass {
    
    public function index()
    {
        //
    }
}
EOF;
        }

        $result = File::put($path.'/'.$name.'.php', $content);
        if ($result) {
            $this->info("$name controller successfully created");
        } else {
            $this->error("Error occurred");
        }
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
