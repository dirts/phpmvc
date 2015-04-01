<?php
namespace Dirt\Lib;

class Action extends Controller{

	#将smarty初始化为对象实例的一个属性, 并借用smarty的方法为自身的方法.
    public function smarty() {
        require_once('./plugins/smarty/Smarty.class.php');
        $this->smarty = new \Smarty();
        $app = $this->get_request('app', 'web');
        $this->smarty->template_dir     = ROOT."/action/" . $app . "/templates";
        $this->smarty->compile_dir      = ROOT."/temp";
		$this->smarty->config_dir       = ROOT."/config";
		$this->smarty->cache_dir        = ROOT."./cache";
		$this->smarty->left_delimiter   = '{:';
		$this->smarty->right_delimiter  = ':}';
	}

	public function fetch($file){
		return $this->smarty->fetch($file);	
	}

	public function assign($name, $varable){
		$this->smarty->assign($name, $varable);	
	}

	public function display($tpl){
        $this->smarty->display($tpl);
	}

}
?>
