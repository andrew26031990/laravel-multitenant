<?php

namespace App\Console\Commands\Make;

use App\Services\Project\ProjectService;
use Illuminate\Foundation\Console\ResourceMakeCommand;
use Str;
use Symfony\Component\Console\Input\InputOption;

class ResourceMakeCustomCommand extends ResourceMakeCommand
{
    protected $name = 'make:resource';

    protected $description = 'Create a new resource class';

    protected function getStub()
    {
        if ($this->option('model')) {
            return 'stubs/resource.model.stub';
        }
        return 'stubs/resource.stub';
    }

    public function handle()
    {
        return parent::handle();
    }

    protected function replaceNamespace(&$stub, $name)
    {

        if ($this->option('model')) {
            $NameInput = $this->getNameInput();
            $projectService = new ProjectService();

            if (strpos($NameInput, 'ResourceResource')) {
                $modelName = basename(Str::replace('ResourceResource', 'Resource', $NameInput));
            } else {
                $modelName = basename(Str::replace('Resource', '', $NameInput));
            }
            $namespace = Str::replace('/', '.', $NameInput);
            try {
                $modelPath = $projectService->getModels()[$modelName];
                $model = new $modelPath();
                $namespaceRelation = Str::replace(basename(Str::replace('.', '/', $namespace)), '', $namespace);
                $stub = Str::replace('{{ swaggerParams }}',  $projectService->swaggerParamsGeneratorFromModel($model, $namespaceRelation, 'Resource'), $stub);
                $stub = Str::replace('{{ params }}', $projectService->resourceTemplateGenerate($model), $stub);
                $stub = Str::replace('{{ project }}', $namespace, $stub);
                $stub = Str::replace('{{ Model }}', class_basename($model), $stub);
            } catch (\Throwable $th) {
                $stub = Str::replace('{{ swaggerParams }}',  '', $stub);
                $stub = Str::replace('{{ params }}', '', $stub);
                $stub = Str::replace('{{ project }}', $namespace, $stub);
            }
        }

        return parent::replaceNamespace($stub, $name);
    }

    protected function getOptions()
    {
        return [...parent::getOptions(), ['model', null, InputOption::VALUE_NONE, 'Create with params']];
    }
}
