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
                            {--resource : Generate a resource controller class}';

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
        
        $base_controller = config('settings.base_controller');

        if ($this->option('resource')) {
            $content = File::get(base_path('stubs/controller/resource_controller_template.php'));
        } else {
            $content = File::get(base_path('stubs/controller/simple_controller_template.php'));
        }

        $content = str_replace('{$controller_name}', $name, $content);
        $content = str_replace('{$base_controller}', $base_controller, $content);

        $result = File::put($path.'/'.$name.'.php', $content);
        if ($result) {
            $this->info("Controller created successfully");
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
