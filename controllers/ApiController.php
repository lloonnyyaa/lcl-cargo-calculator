<?php

namespace app\controllers;

use app\models\History;
use app\models\Client;

class ApiController {

    public function getAll() {
        $messages = History::getAllMessages();
        $this->_sendJson($messages);
    }
    
    public function get($data) {
        $messages = History::getMessagesByClient($data);
        $this->_sendJson($messages);
    }

    public function sended($id) {
        if($result = History::sendedMessage($id))
            $this->_sendJson($result);
        else
            $this->_sendJson($result);
    }

    public function unsended() {
       $messages = History::getUnsendedMessages();
       $this->_sendJson($messages);
    }
    
    public function addClient($code, $tel) {
        $result = Client::addClient($code, $tel);
        $this->_sendJson($result);
    }
    
    public function deleteClient($code) {
        $result = Client::deleteClient($code);
        $this->_sendJson($result);
    }
    
    protected function _sendJson($data) {
        if (is_array($data))
            $data = $this->_unserialize($data);

        @header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        die;
    }

    private function _unserialize($data) {
        foreach ($data as $key => $value) {
            $data[$key] = array_map(function($in) {
                if ($this->_isSerial($in)) {
                    return unserialize($in);
                } else {
                    return $in;
                }
            }, $value);
        }

        return $data;
    }

    private function _isSerial($string) {
        return (@unserialize($string) !== false);
    }

}
