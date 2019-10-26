<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class ControllerPathTest extends TestCase
{
    public function testControllerPath()
    {
        $path = config('settings.controllers_path');
        $result = File::exists($path);
        $this->assertTrue($result);
    }
}
