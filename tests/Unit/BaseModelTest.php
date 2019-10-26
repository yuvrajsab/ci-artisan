<?php

namespace Tests\Unit;

use Tests\TestCase;

class BaseModelTest extends TestCase
{
    public function testBaseModelIsNotEmpty()
    {
        $baseModel = config('settings.base_model');
        $this->assertNotEmpty($baseModel);
    }
}