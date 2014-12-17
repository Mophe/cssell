<?php

class CoreBill {

    function __construct() {
        require __DIR__ . '/vendor/autoload.php';
        ActiveRecord\Config::initialize(function($cfg) {
            $cfg->set_model_directory(__DIR__ . '/models');
            $cfg->set_connections(array(
                'development' => 'mysql://root:@localhost/sell;charset=utf8'
            ));
        });
    }

    public function addBill($money, $introduction) {
        $bill = Bill::first(array('time' => (new DateTime)->format('Y-m-d')));
        var_dump($bill);
        if ($bill === null) {
            Bill::create(array(
                'money' => $money,
                'time' => new DateTime(),
                'introduction' => $introduction
            ));
            return true;
        } else {
            return false;
        }
    }

    public function getBills() {
        $result = array();
        foreach (Bill::all() as $key => $value) {
            $result[$key] = array_intersect_key($value->to_array(), array_flip(array('id', 'money', 'time', 'introduction')));
        }
        return $result;
    }

    public function deleteBill($id) {
        $bill = Bill::first(array('id' => $id));
        if ($bill !== null) {
            $bill->delete();
            return true;
        } else {
            return false;
        }
    }

    public function modifyBill($id, $money, $introduction) {
        $bill = Bill::first(array('id' => $id));
        if ($bill !== null) {
            $bill->update_attributes(array(
                'money' => $money,
                'introduction' => $introduction
            ));
            return true;
        } else {
            return false;
        }
    }

    public function countMoney($start, $end) {
        $sum = 0;
        foreach (Bill::all(array('conditions' => array('DATEDIFF(time, ?) >= 0 AND DATEDIFF(time,?) <= 0', $start, $end))) as $value) {//sql time compare use DATEDIFF
            $sum += $value->money;
        }
        return $sum;
    }

}
