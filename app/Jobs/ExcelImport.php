<?php

namespace App\Jobs;

use App\Imports\RowsImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;
use Maatwebsite\Excel\Facades\Excel;

class ExcelImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $uniqueID;
    protected string $path;

    /**
     * Create a new job instance.
     */
    public function __construct(string $uniqueID, string $path)
    {
        $this->uniqueID = $uniqueID;
        $this->path = $path;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Redis::set($this->uniqueID, 0);
        Excel::import(new RowsImport($this->uniqueID), $this->path);
    }
}
