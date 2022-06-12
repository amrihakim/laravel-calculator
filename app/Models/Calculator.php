<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculator extends Model
{
    use HasFactory;

    protected $table = 'calculators';
    protected $fillable = [
        'num1',
        'num2',
        'ops',
        'result'
    ];
}
