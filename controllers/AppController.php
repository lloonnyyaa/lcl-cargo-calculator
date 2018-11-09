<?php

namespace app\controllers;

class AppController {

    public $data;

    public function __construct() {
        $this->data = include(ROOT . '/config/data.php');
    }

    public function render($view, $params) {
        $file = ROOT . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $view . '.php';

        if (file_exists($file)) {
            ob_start();
            ob_implicit_flush(false);
            extract($params, EXTR_OVERWRITE);
            require($file);

            return ob_get_clean();
        } else {
            return '';
        }
    }
    
    public function isAjax() {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' );
    }

}
