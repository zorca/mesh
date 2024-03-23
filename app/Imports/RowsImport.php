<?php

namespace App\Imports;

use App\Models\Row;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RowsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, SkipsEmptyRows, SkipsOnError
{
    use RemembersRowNumber;

    protected string $uniqueImportID;

    public function __construct(string $uniqueImportID)
    {
        $this->uniqueImportID = $uniqueImportID;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        Redis::set($this->uniqueImportID, $this->getRowNumber());
        return new Row([
            'id' => $row['id'],
            'name' => $row['name'],
            'date' => Date::excelToDateTimeObject($row['date']),
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * @param \Throwable $e
     */
    public function onError(\Throwable $e): void
    {
        Log::debug($e->getMessage());
    }
}
