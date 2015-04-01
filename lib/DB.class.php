<?php
namespace Dirt\Lib;

class DB {

    static $conns = array();
    
    static function get_conn() {
        $dsn = "mysql:host=127.0.0.1;dbname=test";
        $db = new \PDO($dsn, 'root', 'stupid');
        $d = $db->exec('select * from t_task ');
        return $db;
    }

}


?>
