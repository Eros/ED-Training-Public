<?php
/**
 * Created by PhpStorm.
 * User: George
 * Date: 11-Apr-18
 * Time: 8:44 PM
 */

class database
{
    private static $dInstance;

    public static function init(){
        $dsn = 'mysql:dbname=' .DB_DATABASE;

        if(DB_CONNTYPE == 'unixsocket'){
            $dsn .= ';unix_socket=' .DB_UNIX_SOCKET;
        } else if(DB_CONNTYPE == 'host'){
            $dsn .= ';host=' .DB_HOST_ADDRESS;
            $dsn .= ';port' .DB_HOST_PORT;
        } else {
            die("Something broke when it came to the connection type!");
        }

        try {
            $dbh = new PDO($dsn, DB_USER, DB_PASS);
                self::$dInstance = $dbh;
        } catch (PDOException $e){
            die('Database is now broken!' + $e -> getMessage());
        }
    }

    public static function this(){
        if(isset(self::$dInstance)){
            return self::$dInstance;
        } else {
            die("Error returning the db instance!");
        }
    }
}