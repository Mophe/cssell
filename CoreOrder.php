<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CoreRecord
 *
 * @author HJava
 */
class CoreOrder {

    function __construct() {
        require __DIR__ . '/vendor/autoload.php';
        ActiveRecord\Config::initialize(function($cfg) {
            $cfg->set_model_directory(__DIR__ . '/models');
            $cfg->set_connections(array(
                'development' => 'mysql://root:@localhost/sell;charset=utf8'
            ));
        });
    }

    public function addOrder($name, $phone, $commodities, $content) {
        $price = 0;
        $all = array();
        var_dump(Commodity::all());
        foreach (Commodity::all() as $value) {
            $all[$value->id] = $value->name;
        }
        foreach ($commodities as $value) {
            $price += $value['price'] * $value['number'];
        }
        $order = new Order(array(
            'name' => $name,
            'phone' => $phone,
            'content' => $content,
            'price' => $price,
            'time' => new DateTime()
        ));
        $order->save();
        foreach ($commodities as $value) {
            if (in_array($value['name'], $all)) {
                Record::create(array(
                    'order_id' => $order->id,
                    'commodity_id' => array_search($value['name'], $all),
                    'number' => $value['number']
                ));
            } else {
                return false;
            }
        }
        return true;
    }

    public function getOrders() {

    }

    public function getOrderDetails() {

    }

    public function countMoney($start, $end) {
        $records = Order::all(array('conditions' => array('time > ? and time < ?', $start, $end)));
        $price = 0;
        foreach ($records as $value) {
            $price += $value['price'];
        }
        return price;
    }

    public function deleteOrder($id) {
        $order = Order::first(array('conditions' => array('id' => $id)));
        if ($order !== null) {
            $order->delete();
            return true;
        } else {
            return false;
        }
    }

}
