<?php

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
        $result = array();
        foreach (Order::all() as $key => $value) {
            $result[$key] = array_intersect_key($value->to_array(), array_flip(array('id', 'name', 'phone', 'content', 'price', 'time')));
        }
        return $result;
    }

    public function getOrderDetails($id) {
        $result = array();
        foreach (Record::all(array('order_id' => $id)) as $key => $value) {
            $result[$key] = array(
                'commodity' => $value->commodity->name,
                'price'=>$value->commodity->price,
                'number' => $value->number
            );
        }
        return $result;
    }

    public function deleteOrder($id) {
        $order = Order::first(array('id' => $id));
        if ($order !== null) {
            Record::delete_all(array('conditions' => array('order_id' => $id)));
            $order->delete();
            return true;
        } else {
            return false;
        }
    }

}

