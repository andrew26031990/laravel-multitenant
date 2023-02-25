<?php

namespace App\Console\Commands\Make;

use Illuminate\Routing\Console\ControllerMakeCommand;
use Str;
use Symfony\Component\Console\Input\InputOption;

class ControllerMakeCustomCommand extends ControllerMakeCommand
{
    protected $name = 'make:controller';

    protected function getStub()
    {
        if ($this->option('mrs')) {
            $stub = null;
            $stub = '/stubs/controller.service.stub';
            return $this->resolveStubPath($stub);
        }
        return parent::getStub();
    }


    protected function buildClass($name)
    {
        if ($this->option('mrs')) {
            $controllerNamespace = $this->getNamespace($name);
            $replace = [];
            $replace = $this->buildServiceReplacements($replace, $name);
            $replace["use {$controllerNamespace}\Controller;\n"] = '';

            return str_replace(
                array_keys($replace),
                array_values($replace),
                parent::buildClass($name)
            );
        }
        return parent::buildClass($name);
    }

    protected function buildServiceReplacements(array $replace)
    {
        $name = $this->argument('name');
        $controllerVariable = Str::lower(basename(Str::replace('Controller', '', $name)));
        $project = Str::replace(basename($name), '', $name);
        $way = Str::replace('/', '.', $project);
        $path = Str::replace('.', '\\', $way);
        $modelVariable = Str::lower($this->option('mrs'));
        $model = Str::ucfirst($modelVariable);
        $this->generateServiceRequests($project . 'Store' . $model . 'Request');
        $this->generateServiceRequests($project . 'Update' . $model . 'Request');
        return array_merge($replace, [
            '{{ projectVariable }}' => Str::lower($project),
            '{{ model }}' => $model,
            '{{ path }}' => $path,
            '{{ way }}' => $way,
            '{{ wayVariable }}' => Str::lower($way),
            '{{ controllerVariable }}' => $controllerVariable,
            '{{ modelVariable }}' => $modelVariable,
            '{{ routeName }}' => Str::plural($modelVariable),
        ]);
    }


    protected function generateServiceRequests($request)
    {

        try {
            $this->call('make:request', [
                'name' => $request,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }

        return $request;
    }

    protected function getOptions()
    {
        return [...parent::getOptions(), ['mrs', null, InputOption::VALUE_OPTIONAL, 'Generate FormRequest classes for store and update']];
    }
}
