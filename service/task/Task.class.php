<?php
namespace Dirt\Service\Task;
use \Dirt\Lib\Service;
use \Dirt\Model\Task\TaskModel;

class Task extends Service {
    
    public function get_task() {
        $model = new TaskModel();
        var_dump($model); 
        return 'task';
    }   

}

?>
