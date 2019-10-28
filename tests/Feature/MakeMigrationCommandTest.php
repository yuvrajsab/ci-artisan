<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class MakeMigrationCommandTest extends TestCase
{
    public function testMakeMigrationCommand()
    {
        $migration_name = 'testMigration';

        $this->artisan('make:migration', ['name' => $migration_name])
        ->expectsOutput('Migration created successfully')
        ->assertExitCode(0);

        $this->assertFileExists(config('settings.migrations_path').date('YmdHis').'_'."$migration_name.php");

        $content = File::get(config('settings.migrations_path').date('YmdHis').'_'."$migration_name.php");
        
        $this->assertStringContainsString(ucfirst($migration_name), $content);
    }

    public function testMakeMigrationCommandWithCreateTableOption()
    {
        $migration_name = 'testMigration';
        $table_name = 'Test';

        $this->artisan('make:migration', ['name' => $migration_name, '--create' => $table_name])
        ->expectsOutput('Migration created successfully')
        ->assertExitCode(0);

        $this->assertFileExists(config('settings.migrations_path').date('YmdHis').'_'."$migration_name.php");

        $content = File::get(config('settings.migrations_path').date('YmdHis').'_'."$migration_name.php");
        
        $this->assertStringContainsString(ucfirst($migration_name), $content);
        $this->assertStringContainsString(strtolower($table_name), $content);
    }
}
