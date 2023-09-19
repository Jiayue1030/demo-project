<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RiskFreeRate extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'risk_free_rates';

    protected $fillable = [
        'year','year_x','yield','project_id'
    ];

    protected $hidden = [
        'created_by',
        'ipaddress'
    ];
}
