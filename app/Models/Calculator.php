<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculator extends Model
{
    // inisialisasi tabel
    protected $table = 'calculators';

    // inisialisasi kolom
    protected $fillable = [
        'num1',
        'num2',
        'ops',
        'result'
    ];
}
