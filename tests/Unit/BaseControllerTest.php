<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class BaseControllerTest extends TestCase
{
    public function testBaseControllerIsNotEmpty()
    {
        $baseController = config('settings.base_controller');
        $this->assertNotEmpty($baseController);
    }
}
