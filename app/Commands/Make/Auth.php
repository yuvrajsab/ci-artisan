<?php

namespace App\Commands\Make;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\File;
use LaravelZero\Framework\Commands\Command;

class Auth extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'make:auth';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Scaffold basic login and registration views';

    private function databaseConn()
    {
        $host = $this->ask('Database host', 'localhost');
        $port = $this->ask('Database port', '3306');
        $username = $this->ask('Database username', 'root');
        $password = $this->secret('Database password');
        $database = $this->ask('Database name');

        $conn = mysqli_connect($host, $username, $password, $database, $port);

        if (mysqli_connect_errno()) {
            $this->error("Connection failed: ".mysqli_connect_error());
        }

        $sql = File::get(base_path("stubs/auth/third_party/ion_auth/sql/ion_auth.sql"));
        $res = mysqli_multi_query($conn, $sql);
        if ($res != false) {
            return true;
        } else {
            return false;
        }

        mysqli_close($conn);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->task("Copying config file", function () {
            File::copy(base_path('stubs/auth/config/config.php'), config('settings.config_path').'config.php');
        });
        
        $this->task("Copying controllers", function () {
            File::copy(base_path('stubs/auth/controllers/Auth.php'), config('settings.controllers_path').'Auth.php');
            File::copy(base_path('stubs/auth/controllers/Home.php'), config('settings.controllers_path').'Home.php');
        });
        
        $this->task("Copying benedmunds.com/ion_auth package", function () {
            if (! File::exists(config('settings.third_party_path'))) {
                File::makeDirectory(config('settings.third_party_path'));
            }
            File::copyDirectory(base_path('stubs/auth/third_party/ion_auth'), config('settings.third_party_path').'ion_auth');
        });
        
        $this->task("Migrating tables and seeding data", function () {
            $res = $this->databaseConn();
            return $res;
        });

        $this->task("Scaffolding views", function () {
            File::copyDirectory(base_path('stubs/auth/views/auth'), config('settings.views_path').'auth');
            File::copy(base_path('stubs/auth/views/home.php'), config('settings.views_path').'home.php');
            File::copy(base_path('stubs/auth/views/welcome_message.php'), config('settings.views_path').'welcome_message.php');
        });

        $this->info("All done! Please change your base path in application/config/config.php according to your server (if needed).");
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
