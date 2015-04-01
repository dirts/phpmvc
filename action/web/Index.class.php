<?php
namespace Dirt\Action\Web;

class Index extends \Dirt\Lib\Action {

    public function run() {
        $this->smarty();
        
        //接受参数
        $name = $this->get('name', '咋办项目组smarty:hello world!');
        //$this->success(array('a' => 1));//'name' => $name));
        //return;
        $this->assign('name', '咋办软件项目租');
        $this->display('index.tpl');
    }
}

?>
