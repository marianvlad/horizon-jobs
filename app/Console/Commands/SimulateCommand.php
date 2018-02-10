<?php

namespace App\Console\Commands;

use App\Jobs\TestJob;
use Illuminate\Console\Command;

class SimulateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simulate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        app('files')->put(base_path('output.log'), '');
        $key = $this->generateKey();

        $this->writeKeyOnJob($key);

        sleep(4);

        // Kill Horizon
        $this->call('horizon:terminate');
        
        for ($i = 0; $i < mt_rand(3, 7); $i++) { 
            TestJob::dispatch($i)->onQueue('test');
        }
    }

    protected function writeKeyOnJob($key)
    {
        $content = app('files')->get(app_path('Jobs/TestJob.php'));

        $lineToChange = explode("\n", $content)[40];
        $newLine = sprintf('        $key = "%s";', $key);

        app('files')->put(app_path('Jobs/TestJob.php'), str_replace($lineToChange, $newLine, $content));
    }

    protected function generateKey()
    {
        app('files')->put(base_path('key.job'), $key = str_random());

        return $key;
    }
}
