<?php

namespace App\Libraries;

class Helper
{

    public static function validate($data,$field){
        if(isset($data) && (trim($data) != '')) {
            switch($field){
                case 'name':
                    break;
                case 'email':
                    break;
                case 'password':
                    if(strlen($data) < 4)
                        return false;
                    break;
                case 'id':
                    break;
            }
            return true;
        }
        else{
            return false;
        }
    }

}