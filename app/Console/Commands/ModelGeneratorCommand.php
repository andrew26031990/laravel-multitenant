<?php

namespace App\Console\Commands;

use App\Services\Project\ProjectService;

use Illuminate\Console\Command;
use Log;
use Str;

class ModelGeneratorCommand extends Command
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
    protected $signature = 'model:generate';

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
                $data = [
                    'name' => Str::studly(Str::singular($key)),
                    '--table' => $key,
                ];

                if (strpos($key, '_translations')) {
                    $data['--translation'] = true;
                }

                try {
                    $this->call('make:model', $data);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            });

        return Command::SUCCESS;
    }
}
