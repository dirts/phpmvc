<?php
namespace Dirt\Apps\Web;

class Api extends \Dirt\Lib\Action {

    public function run() {
        $userinfo = array(
                'uid'   => 1,
                'name'  => '王琪',
            );
        $this->success($userinfo);
    }
}

?>
