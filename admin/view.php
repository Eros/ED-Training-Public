<?php
/**
 * Created by PhpStorm.
 * User: George
 * Date: 11-Apr-18
 * Time: 9:55 PM
 */

class view
{
    public static function load($valName, $data = array()){
        if(!file_exists(VIEW_PATH . '/' . $valName . '.php')){
            die("error! Value not found!");
        } else {
            if(is_array($data)){
                foreach ($data as $k => $v) {
                    $$k = $v;
                }
            }
            require_once(VIEW_PATH . '/' . $valName + '.php');
        }
    }
}