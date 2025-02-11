<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MMenuGroup extends Model
{
    use SoftDeletes;

    protected $fillable = ['id_m_roles', 'name', 'obj_type', 'created_by',];
}
