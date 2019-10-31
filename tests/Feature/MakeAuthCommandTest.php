<?php

namespace Tests\Feature;

use Tests\TestCase;

class MakeAuthCommandTest extends TestCase
{
    public function testMakeAuthCommand()
    {
        $this->artisan('make:auth')
        ->expectsQuestion("Please make sure you don't have any file named 'Auth', 'Home', 'Welcome' in your controllers directory\n AND 'auth/login', 'auth/register', 'home', 'welcome_message' in views directory\n otherwise it's content will get replaced", true)
        ->expectsQuestion('Database host', 'localhost')
        ->expectsQuestion('Database port', 3306)
        ->expectsQuestion('Database username', '')
        ->expectsQuestion('Database password', '')
        ->expectsQuestion('Database name', '')
        ->assertExitCode(0);

        $this->assertFileExists(config('settings.controllers_path').'Auth.php');
        $this->assertFileExists(config('settings.controllers_path').'Home.php');
        $this->assertFileExists(config('settings.controllers_path').'Welcome.php');

        $this->assertDirectoryExists(config('settings.third_party_path').'ion_auth');

        $this->assertFileExists(config('settings.views_path').'auth/login.php');
        $this->assertFileExists(config('settings.views_path').'auth/register.php');
        $this->assertFileExists(config('settings.views_path').'home.php');
        $this->assertFileExists(config('settings.views_path').'welcome_message.php');
    }
}
