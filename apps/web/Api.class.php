<?php
namespace Dirt\Apps\Web;
use \Dirt\Service\Task\Task;

class Api extends \Dirt\Lib\Action {

    public function run() {
        $service  =  new Task();
        $str = $service->get_task();
        $userinfo = array(
                'uid'       => 1,
                'name'      => 'wangqi',
                'service'   => $str,
            );
        $this->success($userinfo);
    }
}

?>
