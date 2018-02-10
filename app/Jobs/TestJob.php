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

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        sleep(mt_rand(5, 10));

        $this->witeOutput();
    }

    protected function witeOutput()
    {
        $key = "vt0WzCp4VYlDmTL9";

        app('files')->prepend(base_path('output.log'),
            sprintf('<p><strong class="blue">%s</strong> --- Key: <strong class="red">%s</strong></p>', date('Y-m-d H:i:s'), $key)
        );
    }
}
