<?php
namespace Dirt\Apps\Web;

class Index extends \Dirt\Lib\Action {

    public function run() {
        $this->load_smarty();

        $name = $this->get('name', '咋办项目组smarty:hello world!');
        //$this->success(array('a' => 1, 'name' => $name));
        $this->assign('name', $name);
        $this->display('index.tpl');
    }
}

?>
