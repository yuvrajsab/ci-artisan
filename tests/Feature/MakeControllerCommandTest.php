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
    }

    public function testMakeControllerCommandWithResource()
    {
        $this->artisan('make:controller', ['name' => 'TestController', 'resource'])
            ->expectsOutput('Controller created successfully')
            ->assertExitCode(0);
    }
}
