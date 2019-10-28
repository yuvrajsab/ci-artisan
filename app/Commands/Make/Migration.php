<?php

namespace App\Commands\Make;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\File;
use LaravelZero\Framework\Commands\Command;

class Migration extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'make:migration
                            {name : The name of the migration}
                            {--create= : The table to be created}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create a new migration file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $table_name = $this->option('create');

        if (! File::exists(config('settings.migrations_path'))) {
            File::makeDirectory(config('settings.migrations_path'));
        }

        if ($this->option('create') !== null) {
            $content = File::get(base_path('stubs/migration/create_table_migration_template.php'));            
            $content = str_replace('{$table_name}', strtolower($table_name), $content);
        } else {
            $content = File::get(base_path('stubs/migration/simple_migration_template.php'));            
        }

        $content = str_replace('{$migration_name}', ucfirst($name), $content);
        
        $result = File::put(config('settings.migrations_path').date('YmdHis').'_'.$name.'.php', $content);
        if ($result) {
            $this->info("Migration created successfully");
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
