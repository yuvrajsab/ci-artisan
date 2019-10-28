<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class MakeModelCommandTest extends TestCase
{
    public function testMakeModelCommand()
    {
        $model_name = 'TestModel';

        $this->artisan('make:model', ['name' => $model_name])
        ->expectsOutput('Model created successfully')
        ->assertExitCode(0);

        $this->assertFileExists(config('settings.models_path')."$model_name.php");

        $content = File::get(config('settings.models_path')."$model_name.php");
        
        $this->assertStringContainsString($model_name, $content);
    }

    public function testMakeModelCommandWithinDirectory()
    {
        $model = 'Directory/TestModel';
        $tmp  = explode('/', $model);
        $model_name = end($tmp);

        $this->artisan('make:model', ['name' => $model])
        ->expectsOutput('Model created successfully')
        ->assertExitCode(0);

        $this->assertFileExists(config('settings.models_path')."$model.php");

        $content = File::get(config('settings.models_path')."$model.php");
        
        $this->assertStringContainsString($model_name, $content);
    }
}
