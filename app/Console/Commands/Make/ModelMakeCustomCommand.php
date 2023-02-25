<?php

namespace App\Console\Commands\Make;

use App\Services\Project\ProjectService;
use Illuminate\Foundation\Console\ModelMakeCommand;
use Str;
use Symfony\Component\Console\Input\InputOption;

class ModelMakeCustomCommand extends ModelMakeCommand
{

    protected $name = 'make:model';

    public function handle()
    {

        $table = $this->option('table');

        if ($table && !strpos($table, '_translations')) {
            $this->createRepository();
            $this->createService();
        }

        parent::handle();
    }

    // /**
    //  * Get the stub file for the generator.
    //  *
    //  * @return string
    //  */

    protected function getStub()
    {
        if ($this->option('pivot')) {
            return 'stubs/model.pivot.stub';
        }

        if ($this->option('morph-pivot')) {
            return 'stubs/model.morph-pivot.stub';
        }

        if ($this->option('translation')) {
            return 'stubs/model.translation.stub';
        }

        return 'stubs/model.stub';
    }


    protected function createRepository()
    {
        $resource = Str::studly(class_basename($this->argument('name')));

        $this->call('make:repository', array_filter([
            'name' => "{$resource}Repository"
        ]));
    }

    protected function createService()
    {
        $resource = Str::studly(class_basename($this->argument('name')));

        $this->call('make:service', array_filter([
            'name' => "{$resource}Service",
            '--repository' => true
        ]));
    }

    protected function getOptions()
    {
        return [
            ...parent::getOptions(),
            ['table', null, InputOption::VALUE_OPTIONAL, 'Create repository, service'],
            ['translation', null, InputOption::VALUE_OPTIONAL, 'Create repository, service']
        ];
    }


    protected function replaceNamespace(&$stub, $name)
    {
        if ($this->option('table')) {
            $projectService = new ProjectService();
            $comment = $projectService->swaggerParamsGeneratorFromTable($this->option('table'));
            $stub = Str::replace('{{ swaggerParams }}', $comment ? $comment : '', $stub);
        }

        return parent::replaceNamespace($stub, $name);
    }
}
