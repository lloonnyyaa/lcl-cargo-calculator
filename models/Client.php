<?php

namespace app\models;

use app\components\Db;

class Client {

    public static function addClient($clientCode, $tel) {
        $db = Db::getConnection();

        $hashTel = password_hash($tel, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `clients` (`client`, `tel`) VALUES (:code, :tel)
                ON DUPLICATE KEY UPDATE `tel` = :tel";

        $result = $db->prepare($sql);
        $result->bindParam(':code', $clientCode, \PDO::PARAM_STR);
        $result->bindParam(':tel', $hashTel, \PDO::PARAM_STR);

        return $result->execute();
    }
    
    public static function getClient($code) {
        $db = Db::getConnection();

        $sql = "SELECT * FROM `clients` WHERE `client` = :client";

        $result = $db->prepare($sql);
        $result->bindParam(':client', $code, \PDO::PARAM_STR);
        $result->execute();

        return $result->fetch(\PDO::FETCH_ASSOC);
    }
    
    public static function deleteClient($code) {
        $db = Db::getConnection();

        $sql = "DELETE FROM `clients` WHERE `client` = :client";

        $result = $db->prepare($sql);
        $result->bindParam(':client', $code, \PDO::PARAM_STR);
        
        return $result->execute();
    }

}
