<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MMenuGroupDetail extends Model
{
    use SoftDeletes;
    protected $fillable = ['id_m_menu_groups', 'id_m_menus', 'flag_create', 'flag_read', 'flag_update', 'flag_delete', 'flag_export', 'flag_import', 'obj_type', 'created_by',];
}
