<?php

namespace App\Imports;

use App\Models\Row;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RowsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Row([
            'id' => $row['id'],
            'name' => $row['name'],
            'date' => Date::excelToDateTimeObject($row['date']),
        ]);
    }
}
