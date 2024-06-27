<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class ManagerMakeCommand extends GeneratorCommand
{
    protected $name = 'make:manager';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new manager class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Manager';

    protected function getStub(): string
    {
        return base_path('stubs/manager.stub');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Managers';
    }
}
