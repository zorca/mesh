<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    use HasFactory;

    protected $primaryKey = 'row_id';

    protected $fillable = ['id', 'name', 'date'];

    protected $casts = [
        'date' => 'date:d.m.y',
    ];
}
