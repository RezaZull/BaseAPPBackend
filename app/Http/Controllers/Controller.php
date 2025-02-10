<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected $objTypes = [
        "M_Menu" => "1",
        "M_Role" => "2",
        "M_RoleMenu" => "3",
        "M_User" => "4",
    ];
}
