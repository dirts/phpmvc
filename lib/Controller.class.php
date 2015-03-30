<?php
namespace Dirt\Lib;

class Controller {

    public function api($code, $msg, $data) {
        $return = array(
            'code'  => $code,
            'msg'   => $msg,
            'data'  => $data,
        );
        echo json_encode($return);
    }
}
