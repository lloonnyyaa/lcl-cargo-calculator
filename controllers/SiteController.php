<?php

namespace app\controllers;
use app\controllers\CalculatorController;

class SiteController extends AppController {

    public function index() {
        echo $this->render('homepage', [
            'title' => 'Calc'
        ]);

        return true;
    }

    public function code() {
        $code_arr = filter_input(INPUT_POST, 'code', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        
        if (!empty($code_arr)) {
            $client_code = (string) implode($code_arr);
            $_SESSION['client_code'] = $client_code;
            header('Location: /calc');
            exit();
        }

        echo $this->render('code', [
            'title' => 'Client code'
        ]);

        return true;
    }

    public function calc() {
        if($this->isAjax()){
            $country = filter_input(INPUT_POST, 'country');
            echo json_encode($this->data['countries'][$country]);
            die;
        }
        
        $form_submit = filter_input(INPUT_POST, 'submit_calc') !== null;
        if ($form_submit) {
            $form_data = filter_input(INPUT_POST, 'calc', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
            new CalculatorController($form_data);
        }
        
        echo $this->render('calc', [
            'title' => 'Calculator',
            'countries' => array_keys($this->data['countries']),
            'ports' => [],
            'cities' => $this->data['cities'],
            'form_submit' => $form_submit
        ]);

        return true;
    }
}
