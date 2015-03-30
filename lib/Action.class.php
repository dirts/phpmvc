<?php
namespace Dirt\Lib;

class Action extends Controller{

	#将smarty初始化为对象实例的一个属性, 并借用smarty的方法为自身的方法.
	function init_smarty(){
		$this->smarty = new Smarty();
		$this->smarty->compile_dir      = ROOT.TEMP;
		$this->smarty->config_dir       = ROOT.CONFIGS;
		$this->smarty->cache_dir        = ROOT.CACHE;
		$this->smarty->left_delimiter   = '{%';
		$this->smarty->right_delimiter  = '%}';
	}

    public function success($data, $code = 0, $msg = 'success') {
        $this->api($code, $msg, $data);
    }
     
    public function error($code = 40001, $msg = '未知错误!', $data = array()) {
        $this->api($code, $msg, $data);
    }
    
    //获取request
    public function get_request($name){
        $args       = func_get_args();
        $length     = func_num_args();

        if (!isset($this->request->REQUEST[$name])) {
            if ($length == 1) {
                return null;
            }
            return $args[1];
        } else {
            return $this->request->REQUEST[$name];
        }
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
