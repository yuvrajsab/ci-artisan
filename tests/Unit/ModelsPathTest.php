<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class ModelsPathTest extends TestCase
{
    public function testModelsPath()
    {
        $path = config('settings.models_path');
        $result = File::exists($path);
        $this->assertTrue($result);
    }
}
