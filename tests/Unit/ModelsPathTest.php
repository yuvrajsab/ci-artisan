<?php

namespace Tests\Unit;

use Tests\TestCase;

class ModelsPathTest extends TestCase
{
    public function testModelsPath()
    {
        $this->assertDirectoryExists(config('settings.models_path'));
    }
}
