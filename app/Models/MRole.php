<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MRole extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'obj_type', 'created_by', 'obj_type'];
}
