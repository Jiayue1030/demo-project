<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'projects';

    protected $fillable = [
        'name',
        'client_id',
        'valuation_target',
        'ref_num',
        'valuation_date',
        'sum_long_service_payment',
        'max_long_service_payment',
        'max_monthly_employer_contribution',
        'net_annual_return_mpfasset',
        'status',
        'created_by',
        'discount_rate',
    ];
}
