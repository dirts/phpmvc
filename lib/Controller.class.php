<?php
namespace Dirt\Lib;

class Controller {

     
    public $request;

    public function run() {
        $this->parse_request();
        $this->dispatch();
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
    //获取request
    public function get($name){
        $args       = func_get_args();
        $length     = func_num_args();

        if (!isset($this->request->GET[$name])) {
            if ($length == 1) {
                return null;
            }
            return $args[1];
        } else {
            return $this->request->GET[$name];
        }
    }


    public function dispatch() {
        $arr = array('Dirt','Action');
        $arr[] = ucfirst($this->get_request('mod', 'web'));
        $arr[] = ucfirst($this->get_request('act', 'index'));
        $namespace = join("\\", $arr);
        $instance = new $namespace();
        $instance->run();
    }


    public function parse_request() {
        foreach ($_REQUEST as $key => $val) {
           $this->request->REQUEST[$key] = htmlspecialchars($val);
        } 
        foreach ($_GET as $k => $v) {
           $this->request->GET[$k] = htmlspecialchars($v);
        }
        foreach ($_POST as $k => $v) {
           $this->request->POST[$k] = htmlspecialchars($v);
        }
        return $this->request;
    }

    public function api($code, $msg, $data) {
        $return = array(
            'code'  => $code,
            'msg'   => $msg,
            'data'  => $data,
        );
        echo json_encode($return);
    }
    
    public function success($data, $code = 0, $msg = 'success') {
        $this->api($code, $msg, $data);
    }
     
    public function error($code = 40001, $msg = '未知错误!', $data = array()) {
        $this->api($code, $msg, $data);
    }
}
