<?php

namespace app\controllers;

use app\models\Calculator;
use app\models\History;

class CalculatorController {

    private $data;
    private $port;
    private $city;
    private $rate;
    private $transit_time;
    private $weight;
    private $volume;
    private $freight;
    private $prr;
    private $separate_under;
    private $separate_after;
    private $assembly_under;
    private $assembly_after;

    public function __construct(array $data) {
        if (empty($data))
            return;

        $this->data = $data;

        $this->port = $data['port'];
        $this->city = $data['city'];
        $this->weight = (($data['weight'] / 1000) < 1) ? 1 : ($data['weight'] / 1000);
        $this->volume = $data['volume'] < 1 ? 1 : $data['volume'];

        $tmp = Calculator::getRate($this->port);
        $this->rate = (int) $tmp['rate'];
        $this->transit_time = (int) $tmp['transit_time'];

        $this->freight = $this->_calculateFreight();
        $this->prr = $this->_calculatePrr();
        $this->separate_under = $this->_calculateToSity('car_separate_under_customs');
        $this->separate_after = $this->_calculateToSity('car_separate_after_customs');
        $this->assembly_under = $this->_calculateToSity('car_assembly_under_customs');
        $this->assembly_after = $this->_calculateToSity('car_assembly_after_customs');

        $this->_insertHistory();
    }

    private function _calculateFreight() {
        $type = $this->_volumeOrWeight();

        if ($type == 'volume' && ($this->volume > 20.1 && $this->volume <= 29)) {
            $this->rate += 5;
        } elseif ($type == 'volume' && $this->volume > 30) {
            $this->rate += 10;
        }

        return max($this->volume, $this->weight) * $this->rate;
    }

    private function _calculatePrr() {
        if ($this->weight < 3 && $this->volume < 3)
            return 0;
        else
            return 60;
    }

    private function _calculateToSity($table) {
        $type = $this->_volumeOrWeight();
        $rates = Calculator::getCarRate($this->city, $type, $table);

        return $this->_getClosest($this->$type, $rates);
    }

    private function _insertHistory() {
        $client = filter_var($_SESSION['client_code']);
        $request_data = serialize($this->data);
        $result_data = serialize([
            'freight' => $this->freight,
            'prr' => $this->prr,
            'separate_under' => $this->separate_under,
            'separate_after' => $this->separate_after,
            'assembly_under' => $this->assembly_under,
            'assembly_after' => $this->assembly_after,
            'transit_time' => $this->transit_time
        ]);

        return History::insertHistory($client, $request_data, $result_data);
    }

    private function _volumeOrWeight() {
        $array = [
            'volume' => $this->volume,
            'weight' => $this->weight
        ];

        $type = array_keys($array, max($array));

        return $type[0];
    }

    function _getClosest($search, $arr) {
        $closest = null;

        foreach (array_keys($arr) as $item) {
            if ($item > $search) {
                $closest = $item;
                break;
            }
        }

        if (is_null($closest))
            return $closest = end($arr);

        return $arr[$closest];
    }

}
