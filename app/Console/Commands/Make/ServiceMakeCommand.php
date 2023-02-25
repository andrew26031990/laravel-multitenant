<?php

namespace App\Console\Commands\Make;

use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'make:service')]
class ServiceMakeCommand extends GeneratorCommand
{
    use CreatesMatchingTest;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:service';

    /**
     * The name of the console command.
     *
     * This name is used to identify the command during lazy loading.
     *
     * @var string|null
     *
     * @deprecated
     */
    protected static $defaultName = 'make:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Service class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Service';


    protected function getStub()
    {
        if ($this->option('repository')) {
            return 'stubs/service.repository.stub';
        }

        return 'stubs/service.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return  $rootNamespace . '\\Services';
    }


    protected function getOptions()
    {
        return [
            ['repository', 'R', InputOption::VALUE_NONE, 'Create new form request classes and use them in the resource controller'],
        ];
    }

    protected function replaceNamespace(&$stub, $name)
    {
        if (strpos($name, 'ServiceService')) {
            $repository = Str::replace('ServiceService', 'ServiceRepositoryInterface', $this->getNameInput());
            $repositoryVariable = mb_convert_case(Str::replace('ServiceService', 'Service', $this->getNameInput()), MB_CASE_LOWER, 'UTF-8');
        } else {
            $repository = Str::replace('Service', 'RepositoryInterface', $this->getNameInput());
            $repositoryVariable = mb_convert_case(Str::replace('Service', '', $this->getNameInput()), MB_CASE_LOWER, 'UTF-8');
        }
        $stub = Str::replace('{{ Repository }}', $repository, $stub);
        $stub = Str::replace('{{ RepositoryVariable }}',  $repositoryVariable, $stub);
        $stub = Str::replace('{{ namespacedRepository }}', 'use App\Repositories\\' . $repository . ';', $stub);

        return parent::replaceNamespace($stub, $name);
    }
}
