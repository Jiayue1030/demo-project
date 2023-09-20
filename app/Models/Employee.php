<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use MoonShine\Traits\Models\HasMoonShineChangeLog; 

class Employee extends Model
{
    use HasFactory, SoftDeletes,HasMoonShineChangeLog;

    protected $table = 'employees';

    protected $fillable = [
        'name', 
        'staff_no',
        'project_id',
        'gender',
        'status',
        'birthday',
        'date_of_join',
        'monthly_income',
        'bonus',
        'adjusted_monthly_income',
        'monthly_wage',
        'gratuities_paid',
        'mandatory_mpf_benefits',
        'voluntary_mpf_benefits',
        'employer_contribution',
        'department',
    ];


}
