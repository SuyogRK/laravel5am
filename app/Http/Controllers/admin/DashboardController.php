<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DashboardController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function login(){


        return view($this->adminPath.'.login.login');
    }

    public function admin(){
        return view($this->adminPath.'.pages.dashboard',$this->data);
    }






}
