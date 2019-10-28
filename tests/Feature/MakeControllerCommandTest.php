<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class MakeControllerCommandTest extends TestCase
{

    public function testMakeControllerCommandWithoutResource()
    {
        $controller_name = 'TestController';

        $this->artisan('make:controller', ['name' => $controller_name])
        ->expectsOutput('Controller created successfully')
        ->assertExitCode(0);

        $this->assertFileExists(config('settings.controllers_path')."/$controller_name.php");

        $content = File::get(config('settings.controllers_path')."/$controller_name.php");
        
        $this->assertStringContainsString($controller_name, $content);
    }

    public function testMakeControllerCommandWithResource()
    {
        $controller_name = 'TestController';

        $this->artisan('make:controller', ['name' => $controller_name, '--resource' => true])
        ->expectsOutput('Controller created successfully')
        ->assertExitCode(0);

        $this->assertFileExists(config('settings.controllers_path')."/$controller_name.php");

        $content = File::get(config('settings.controllers_path')."/$controller_name.php");
        
        $this->assertStringContainsString($controller_name, $content);
        $this->assertStringContainsString('public function index()', $content);
    }

    public function testMakeControllerCommandWithinDirectory()
    {
        $controller = 'Directory/TestController';
        $tmp  = explode('/', $controller);
        $controller_name = end($tmp);

        $this->artisan('make:controller', ['name' => $controller])
        ->expectsOutput('Controller created successfully')
        ->assertExitCode(0);

        $this->assertFileExists(config('settings.controllers_path')."/$controller.php");

        $content = File::get(config('settings.controllers_path')."/$controller.php");
        
        $this->assertStringContainsString($controller_name, $content);
    }
}
