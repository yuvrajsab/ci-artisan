<?php

namespace Tests\Unit;

use Tests\TestCase;

class BaseControllerTest extends TestCase
{
    public function testBaseControllerIsNotEmpty()
    {
        $baseController = config('settings.base_controller');
        $this->assertNotEmpty($baseController);
    }
}
