<?php

namespace App\Console\Commands;

use App\Services\Project\ProjectService;

use Illuminate\Console\Command;

use Str;

class ControllerGeneratorCommand extends Command
{
    public ProjectService $tables;

    public function __construct(ProjectService $tables)
    {
        $this->tables = $tables;
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'controller:generate {name}';

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
        $this->tables->getTables()
            ->map(function ($item, $key) {
                try {
                    $this->call('make:controller', [
                        'name' => $this->argument('name') .  Str::studly(Str::singular($key)) . 'Controller',
                        '--mrs' => Str::studly(Str::singular($key)),
                    ]);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            });

        return Command::SUCCESS;
    }
}
