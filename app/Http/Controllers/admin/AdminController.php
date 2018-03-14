<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{


    public $adminPath='admin.';

    public function __construct()
    {
        $this->data('title',$this->title('admin'));


    }

}
