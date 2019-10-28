<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class MakeTestCommandTest extends TestCase
{

    public function testMakeTestCommand()
    {
        $test_name = 'basictest';

        $this->artisan('make:test', ['name' => $test_name])
        ->expectsOutput('Test created successfully')
        ->assertExitCode(0);

        $this->assertFileExists(config('settings.tests_path')."/$test_name.php");

        $content = File::get(config('settings.tests_path')."/$test_name.php");
        
        $this->assertStringContainsString($test_name, $content);
    }

    public function testMakeTestCommandWithinDirectory()
    {
        $test = 'Directory/basicTest';
        $tmp  = explode('/', $test);
        $test_name = end($tmp);

        $this->artisan('make:test', ['name' => $test])
        ->expectsOutput('Test created successfully')
        ->assertExitCode(0);

        $this->assertFileExists(config('settings.tests_path')."/$test.php");

        $content = File::get(config('settings.tests_path')."/$test.php");
        
        $this->assertStringContainsString($test_name, $content);
    }
}
