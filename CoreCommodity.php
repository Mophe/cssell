<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CoreCommodity
 *
 * @author HJava
 */
class CoreCommodity {

    function __construct() {
        require __DIR__ . '/vendor/autoload.php';
        ActiveRecord\Config::initialize(function($cfg) {
            $cfg->set_model_directory(__DIR__ . '/models');
            $cfg->set_connections(array(
                'development' => 'mysql://root:@localhost/sell;charset=utf8'
            ));
        });
    }

    public function getCommodities() {
        $result = array();
        foreach (Commodity::all() as $key => $value) {
            $result[$key] = array_intersect_key($value->to_array(), array_flip(array('name', 'price', 'introduction')));
        }
        return $result;
    }

    /**
     *
     * @param type $name
     * @param type $price
     * @param type $introduction
     * @return boolean
     *
     * @assert ('a', 10, 'aaa') == true
     */
    public function addCommodity($name, $price, $introduction) {
        $commodity = Commodity::first(array('conditions' => array('name', $name)));
        if ($commodity === null) {
            Commodity::create(array(
                'name' => $name,
                'price' => $price,
                'introduction' => $introduction
            ));
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @param type $name
     * @return boolean
     *
     * @assert ('a') == true
     * @assert ('b') == false
     */
    public function deleteCommodity($name) {
        $commodity = Commodity::first(array('name' => $name));
        if ($commodity) {
            $commodity->delete();
            return true;
        } else {
            return false;
        }
    }

}
