<?php

namespace Tests\Feature;

use Tests\TestCase;

class MakeControllerCommandTest extends TestCase
{

    public function testMakeControllerCommandWithoutResource()
    {
        $this->artisan('make:controller', ['name' => 'TestController'])
        ->expectsOutput('Controller created successfully')
        ->assertExitCode(0);

        $this->assertFileExists(config('settings.controllers_path').'/TestController.php');
    }

    public function testMakeControllerCommandWithResource()
    {
        $this->artisan('make:controller', ['name' => 'TestController', 'resource'])
            ->expectsOutput('Controller created successfully')
            ->assertExitCode(0);

        $this->assertFileExists(config('settings.controllers_path').'/TestController.php');        
    }

    public function testMakeControllerCommandWithinDirectory()
    {
        $this->artisan('make:controller', ['name' => 'Directory/TestController', 'resource'])
            ->expectsOutput('Controller created successfully')
            ->assertExitCode(0);

        $this->assertFileExists(config('settings.controllers_path').'Directory/TestController.php');        
    }
}
