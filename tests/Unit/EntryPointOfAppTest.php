<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class EntryPointOfAppTest extends TestCase
{
    public function testEntryPointPhpFile()
    {
        $path = config('settings.entry_point');
        $result = File::exists($path);
        $this->assertTrue($result);
    }
}
