<?php
namespace App\Datapass;

use Illuminate\Support\Facades\Config;

trait Datapass{

    public $data=[];

    public function data($key,$value=''){
        if(empty($key)) return false;
       return $this->data[$key]=$value;
    }


    public function title($back,$separator= " : : ",$front=null){
        if(!isset($front)){
            $front=Config::get('title.name');
        }

        return $front.$separator.$back;
    }

}

