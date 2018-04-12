<?php
/**
 * Created by PhpStorm.
 * User: George
 * Date: 11-Apr-18
 * Time: 8:50 PM
 */

class protected_controller
{
    public function _construct(){
        if(!$_SESSION['logged_in']){
            header("Location: " .$_SERVER['REQUEST_URI'] . '?controller=user&action=login');
            die('Something broke in the construct for the controller!');
        }
    }
}