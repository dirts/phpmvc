<?php

class Autoload {

    function __construct() {
           spl_autoload_register(array($this, 'loader'));
    }

    public function loader($class) {
        $path = $this->get_path($class);
        if (file_exists($path)) {
            require_once($path);
        }
    }

    public function get_path($class) {
        $arr = explode("\\", $class);
        array_shift($arr);
        $class_name = array_pop($arr);
        $path = "./". strtolower(join("/", $arr)) . '/' . ucfirst($class_name) . ".class.php";
        return $path;
    }

}

$autoloader = new Autoload();

?>
