<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MMenu extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'description', 'obj_type', 'created_by'];
}
