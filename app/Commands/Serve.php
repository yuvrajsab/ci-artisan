<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\File;
use LaravelZero\Framework\Commands\Command;

class Serve extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'serve
                            {--host= : The host address to serve the application on [default: "127.0.0.1"]} 
                            {--port= : The port to serve the application on [default: 8000]}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Serve the application on the PHP development server';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $host = $this->option('host') ?? '127.0.0.1';
        $port = $this->option('port') ?? 8000;
        $file = config('settings.entry_point') == 'index.php' ? '' : config('settings.entry_point');

        if ($this->option('host') != null || $this->option('port') != null) {
            $this->line("Codeigniter development server started: <http://$host:$port>");
            shell_exec("php -S $host:$port $file");
        } else {
            for ($i=0; $i < 100; $i++) { 
                $this->line("Codeigniter development server started: <http://$host:$port>");
                shell_exec("php -S $host:$port $file");
                $port++;
            }
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
