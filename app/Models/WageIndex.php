<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WageIndex extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'year',
        'month',
        'type',
        'index',
        'created_by',
    ];
}
