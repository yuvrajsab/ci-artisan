<?php

namespace App\Commands\Make;

use Exception;
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
        $username = $this->anticipate('Database username', ['root']);
        $password = $this->secret('Database password');
        $database = $this->ask('Database name');

        try {
            $conn = mysqli_connect($host, $username, $password, $database, $port);

            $sql = File::get("ci-artisan_stubs/auth/third_party/ion_auth/sql/ion_auth.sql");

            $res = mysqli_multi_query($conn, $sql);

            if ($res != false) {
                return true;
            } else {
                $this->error("Failed to migrate: ".mysqli_error($conn));
                return false;
            }

            mysqli_close($conn);
        } catch (Exception $e) {
            $this->error($e->getMessage());
            return false;
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (! $this->confirm("Please make sure you don't have any file named 'Auth', 'Home', 'Welcome' in your controllers directory\n AND 'auth/login', 'auth/register', 'home', 'welcome_message' in views directory\n otherwise it's content will get replaced", true)) {
            exit();
        }

        $this->task("Copying benedmunds.com/ion_auth package", function () {
            if (! File::exists(config('settings.third_party_path'))) {
                File::makeDirectory(config('settings.third_party_path'));
            }
            File::copyDirectory('ci-artisan_stubs/auth/third_party/ion_auth', config('settings.third_party_path').'ion_auth');
        });
        
        $this->task("Migrating tables and seeding data", function () {
            $res = $this->databaseConn();
            return $res;
        });

        $this->task("Scaffolding controllers", function () {
            File::copy('ci-artisan_stubs/auth/controllers/Auth.php', config('settings.controllers_path').'Auth.php');
            File::copy('ci-artisan_stubs/auth/controllers/Home.php', config('settings.controllers_path').'Home.php');
            File::copy('ci-artisan_stubs/auth/controllers/Welcome.php', config('settings.controllers_path').'Welcome.php');
        });

        $this->task("Scaffolding views", function () {
            File::copyDirectory('ci-artisan_stubs/auth/views/auth', config('settings.views_path').'auth');
            File::copy('ci-artisan_stubs/auth/views/home.php', config('settings.views_path').'home.php');
            File::copy('ci-artisan_stubs/auth/views/welcome_message.php', config('settings.views_path').'welcome_message.php');
        });

        $this->info("All done! Please change your base path in application/config/config.php according to your server.");
        $this->info("Please make sure your application is connected to database otherwise you will get an database error.");
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
