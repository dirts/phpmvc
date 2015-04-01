<?php
namespace Dirt\Model\Task;
use \Dirt\Lib\Model;

class TaskModel extends Model {
    protected $table  = 't_task';
    protected $primary_key = 'id';
    protected $fields = array('uid','title', 'content', 'is_del', 'ctime');
    protected $conn;



}

?>
