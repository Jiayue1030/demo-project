<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectedLife extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'projected_lives';

    protected $fillable = [
        'gender',
        'year',
        'x',
        'qx',
        'lx',
        'dx',
        'l_x',
        't_x',
        'ex',
        'project_id',
    ];

    protected $hidden = [
        'created_by',
        'ipaddress'
    ];
}
