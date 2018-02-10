<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
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
        sleep(mt_rand(60, 90));

        $this->writeOutput();
    }

    protected function writeOutput()
    {
        $key = "jEX3XevN2wbTdBMR";

        app('files')->prepend(base_path('output.log'),
            sprintf('<p><strong class="blue">%d %s</strong> --- Key: <strong class="red">%s</strong></p>', $this->i, date('Y-m-d H:i:s'), $key)
        );
    }
}
