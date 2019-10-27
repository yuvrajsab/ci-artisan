<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class MakeControllerCommandTest extends TestCase
{

    public function testMakeControllerCommandWithoutResource()
    {
        $controller_name = 'TestController';
        $base_controller = config('settings.base_controller');

        $this->artisan('make:controller', ['name' => $controller_name])
        ->expectsOutput('Controller created successfully')
        ->assertExitCode(0);

        $this->assertFileExists(config('settings.controllers_path')."/$controller_name.php");

        $content = File::get(config('settings.controllers_path')."/$controller_name.php");
        
        $check = false;

        if (strpos($content, $controller_name) !== false && strpos($content, $base_controller) !== false) {
            $check = true;
        }

        $this->assertTrue($check);
    }

    public function testMakeControllerCommandWithResource()
    {
        $controller_name = 'TestController';
        $base_controller = config('settings.base_controller');

        $this->artisan('make:controller', ['name' => $controller_name, '--resource' => true])
        ->expectsOutput('Controller created successfully')
        ->assertExitCode(0);

        $this->assertFileExists(config('settings.controllers_path')."/$controller_name.php");

        $content = File::get(config('settings.controllers_path')."/$controller_name.php");
        
        $check = false;

        if (strpos($content, $controller_name) !== false && 
            strpos($content, $base_controller) !== false &&
            strpos($content, 'public function index()') !== false) {
            $check = true;
        }

        $this->assertTrue($check);        
    }

    public function testMakeControllerCommandWithinDirectory()
    {
        $controller = 'Directory/TestController';
        $tmp  = explode('/', $controller);
        $controller_name = end($tmp);
        $base_controller = config('settings.base_controller');

        $this->artisan('make:controller', ['name' => $controller])
        ->expectsOutput('Controller created successfully')
        ->assertExitCode(0);

        $this->assertFileExists(config('settings.controllers_path')."/$controller.php");

        $content = File::get(config('settings.controllers_path')."/$controller.php");
        
        $check = false;

        if (strpos($content, $controller_name) !== false && strpos($content, $base_controller) !== false) {
            $check = true;
        }

        $this->assertTrue($check);
    }
}
