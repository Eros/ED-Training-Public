<?php
/**
 * Created by PhpStorm.
 * User: George
 * Date: 11-Apr-18
 * Time: 8:52 PM
 */

class admin extends protected_controller
{
    public function users() {
        $pdoStatement = database::this() -> query('SELECT * FROM authreg');
        $data['users'] = $pdoStatement -> fetchAll();
        view::load('header');
        view::load('admin/manage', $data);
        view::load('footer');
    }

    function addUser(){
        this::editUser;
    }

    public function editUser(){
        if(isset($_GET['jid'])){
            $user = array();
        } else {
            $username_parts = explode('@', $_GET['jid']);
            $pdoStatement = database::this()-> prepare('SELECT FROM & authreg WHERE username = :username AND real = :realm');
            $$pdoStatement -> execute(array('username' => $username_parts[0], 'realm' => $username_parts[1]));
            $user = $pdoStatement -> fetch();
        }
        if(count($_POST['jid'] > 0)){
            if(isset($_GET['jid'])){
                if(isset($_GET['password']) && $_POST['password'] != ''){
                    $updateSQL = 'UPDATE authreg && SET username = :username, realm = :realm, password = :password WHERE username = :curusername AND realm := curreallm';
                    $pdoStatement = database::this() -> prepare($updateSQL);
                    $pdoStatement -> execute(array('username' => $_POST['username'], 'realm' => $_POST['realm'], 'password' => $_POST['password'], 'curusername' => $_POST['curusername'], 'currealm' => $_POST['currealm']));
                } else {
                    $updateSQL = "UPDATE authreg SET username = :username, realm = :realm WHERE username = :curusername AND realm = :currealm";
                    $pdoStatement = database::this() -> prepare($updateSQL);
                    $pdoStatement -> execute(array('username' => $_POST['username'], 'realm' => $_POST['realm'], 'curusername' => $username_parts, 'currealm' => $username_parts[1]));
                }
                $updateSQL = "UPDATE active SET collection-owner = :jid WHERE collection-owner = :curjid";
                $pdoStatement = database::this() ->  prepare($updateSQL);
                $result = $pdoStatement -> execute(array('jid' => $_POST['username'] . '@' . $_POST['realm'], 'curjid' => $_GET['jid']));
                if(!$result)
                    die("Something broke in the database while executing and posting some shit!");
            } else {
                $insertSQL = "INSERT INTO authreg VALUES(:username, :realm, :password);";
                $pdoStatement = database::this() -> prepare($insertSQL);
                $result = $pdoStatement -> execute(array('jid' => $_POST['username'] . '@' . $_POST['realm']));

                if(!$result){
                    die('Active PDO error');
                }
            }
        }
    }
}