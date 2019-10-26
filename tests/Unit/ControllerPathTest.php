<?php

namespace Tests\Unit;

use Tests\TestCase;

class ControllerPathTest extends TestCase
{
    public function testControllerPath()
    {
        $this->assertDirectoryExists(config('settings.controllers_path'));
    }
}
