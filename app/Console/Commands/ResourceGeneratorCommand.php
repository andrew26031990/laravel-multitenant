<?php

namespace App\Console\Commands;

use App\Services\Project\ProjectService;
use Illuminate\Console\Command;


class ResourceGeneratorCommand extends Command
{
    public ProjectService $models;

    public function __construct(ProjectService $models)
    {
        $this->models = $models;
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resource:generate {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->models->getModels()
            ->map(function ($item) {
                try {
                    $this->call('make:resource', [
                        'name' => $this->argument('name') . class_basename(new $item()) . 'Resource',
                        '--model' => true,
                    ]);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            });

        return Command::SUCCESS;
    }
}
