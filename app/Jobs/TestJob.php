<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Symfony\Component\Process\Process;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $i;

    public $timeout = 3600;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($i)
    {
        $this->i = $i;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Client;

        if (mt_rand(1, 10) <= 2) {
            throw new Exception('Exception error');
        }

        $client->get(route('test'));

        sleep(mt_rand(60, 90));

        $command = sprintf(
            'whoami'
        );

        $process = new Process($command);
        $process->run();

        sleep(5);
    }

    protected function writeOutput()
    {
        $key = "jEX3XevN2wbTdBMR";

        app('files')->prepend(base_path('output.log'),
            sprintf('<p><strong class="blue">%d %s</strong> --- Key: <strong class="red">%s</strong></p>', $this->i, date('Y-m-d H:i:s'), $key)
        );
    }
}
