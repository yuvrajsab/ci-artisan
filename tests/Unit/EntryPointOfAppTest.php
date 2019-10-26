<?php

namespace Tests\Unit;

use Tests\TestCase;

class EntryPointOfAppTest extends TestCase
{
    public function testEntryPointPhpFile()
    {
        $this->assertFileExists(config('settings.entry_point'));
    }
}
