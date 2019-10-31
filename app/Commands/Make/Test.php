<?php

namespace App\Commands\Make;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\File;
use LaravelZero\Framework\Commands\Command;

class Test extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'make:test
                            {name : The name of the class}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create a new test class in controllers/tests directory';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $argv = explode('/', $this->argument('name'));
        $name = array_pop($argv);

        $path = config('settings.tests_path');

        if (! File::exists(config('settings.tests_path'))) {
            File::makeDirectory(config('settings.tests_path'));
        }

        foreach ($argv as $folder) {
            if (! File::exists($path.$folder)) {
                File::makeDirectory($path.$folder);
            }
            $path .= $folder.'/';
        }
        
        $content = File::get('ci-artisan_stubs/test/simple_unit_test_template.php');
        $content = str_replace('{$test_name}', $name, $content);

        $result = File::put($path.$name.'.php', $content);
        if ($result) {
            $this->info("Test created successfully");
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
