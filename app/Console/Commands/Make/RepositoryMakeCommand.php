<?php


namespace App\Console\Commands\Make;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class RepositoryMakeCommand extends GeneratorCommand
{
    protected $signature = 'make:repository {name}';

    protected $description = 'Create a new repository class';

    protected $type = 'Repository';

    protected function getStub()
    {
        return 'stubs/repository.stub';
    }

    public function handle()
    {
        $this->call('make:repository-interface', ['name' => $this->getNameInput() . 'Interface']);

        return parent::handle();
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Repositories\Eloquent';
    }

    protected function replaceNamespace(&$stub, $name)
    {
        $classname = Str::replace('Repository', '', $this->getNameInput());
        $stub = Str::replace('{{ Model }}', $classname, $stub);
        $stub = Str::replace('{{ namespacedModel }}', 'App\Models\\' . $classname, $stub);

        return parent::replaceNamespace($stub, $name);
    }
}
