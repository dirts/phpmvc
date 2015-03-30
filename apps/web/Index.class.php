<?php
namespace Dirt\Apps\Web;

class Index extends \Dirt\Lib\Action {

    public function run() {
        $this->success(array('a' => 1, 'b' => 2));
    }
}

?>
