<?php

namespace app\models;

use app\components\Db;

class Calculator {

    public static function getRate($port) {
        $db = Db::getConnection();

        $sql = "SELECT `rate`, `transit_time` FROM `rates` WHERE `port` = :port";

        $result = $db->prepare($sql);
        $result->bindParam(':port', $port, \PDO::PARAM_STR);
        $result->execute();
        $rate = $result->fetch(\PDO::FETCH_ASSOC);

        return $rate;
    }

    public static function getTransitTime($port) {
        $db = Db::getConnection();

        $sql = "SELECT `transit_time` FROM `rates` WHERE `port` = :port";

        $result = $db->prepare($sql);
        $result->bindParam(':port', $port, \PDO::PARAM_STR);
        $result->execute();
        $time = $result->fetch(\PDO::FETCH_ASSOC);

        return (int) $time['transit_time'];
    }

    public static function getCarRate($city, $type, $table) {
        $db = Db::getConnection();

        $sql = "SELECT {$type} FROM {$table} WHERE `city` = :city";

        $result = $db->prepare($sql);
        $result->bindParam(':city', $city, \PDO::PARAM_STR);
        $result->execute();
        $rate = $result->fetch(\PDO::FETCH_ASSOC);

        return unserialize($rate[$type]);
    }

}
