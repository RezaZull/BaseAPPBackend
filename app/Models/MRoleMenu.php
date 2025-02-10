<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MRoleMenu extends Model
{
    use SoftDeletes;
    protected $fillable = ['id_m_roles', 'id_m_menus', 'flag_create', 'flag_read', 'flag_update', 'flag_delete', 'flag_export', 'flag_import', 'obj_type', 'created_by',];
}
