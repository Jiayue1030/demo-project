<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MpfBalance extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'year',
        'type',
        'department',
        'project_id',
        'value',
    ];
}
