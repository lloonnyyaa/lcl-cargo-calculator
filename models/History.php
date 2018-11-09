<?php

namespace app\models;

use app\components\Db;

class History {

    public static function insertHistory($client, $request_data, $result_data) {
        $db = Db::getConnection();

        $sql = "INSERT INTO `history`(`client_code`, `request_data`, `result_data`) "
                . "VALUES (:code, :request_data, :result_data)";

        $result = $db->prepare($sql);
        $result->bindParam(':code', $client, \PDO::PARAM_STR);
        $result->bindParam(':request_data', $request_data, \PDO::PARAM_STR);
        $result->bindParam(':result_data', $result_data, \PDO::PARAM_STR);

        return $result->execute();
    }

    public static function getAllMessages() {
        $db = Db::getConnection();

        $sql = "SELECT * "
                . "FROM `history` "
                . "WHERE 1";

        $result = $db->prepare($sql);
        $result->execute();

        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public static function getUnsendedMessages() {
        $db = Db::getConnection();

        $sql = "SELECT `id`, `client_code`, `request_data`, `result_data`, `date` "
                . "FROM `history` "
                . "WHERE `sended` = 0";

        $result = $db->prepare($sql);
        $result->execute();

        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getMessagesByClient($client) {
        $db = Db::getConnection();

        $sql = "SELECT `id`, `client_code`, `request_data`, `result_data`, `date` "
                . "FROM `history` "
                . "WHERE `client_code` = :code "
                . "AND `sended` = 0";

        $result = $db->prepare($sql);
        $result->bindParam(':code', $client, \PDO::PARAM_STR);
        $result->execute();

        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function sendedMessage($id) {
        $db = Db::getConnection();

        $sql = "UPDATE `history` "
                . "SET `sended` = 1 "
                . "WHERE `id` = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, \PDO::PARAM_STR);

        return $result->execute();
    }

}
