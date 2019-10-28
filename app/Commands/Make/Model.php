<?php

namespace App\Commands\Make;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\File;
use LaravelZero\Framework\Commands\Command;

class Model extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'make:model
                            {name : The name of the class}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create a new model class';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $argv = explode('/', $this->argument('name'));
        $name = array_pop($argv);

        $path = config('settings.models_path');
        foreach ($argv as $folder) {
            if (! File::exists($path.$folder)) {
                File::makeDirectory($path.$folder);
            }
            $path .= $folder.'/';
        }
        
        $content = File::get(base_path('stubs/model/simple_model_template.php'));
        $content = str_replace('{$model_name}', $name, $content);
        
        $result = File::put($path.$name.'.php', $content);
        if ($result) {
            $this->info("Model created successfully");
        } else {
            $this->error("An error occurred");
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
