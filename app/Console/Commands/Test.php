<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \App\Jobs\RabbitMQWorker::dispatch();
    }
}
