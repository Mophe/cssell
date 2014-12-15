<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CoreAdvice
 *
 * @author HJava
 */
class CoreAdvice {

    function __construct() {
        require __DIR__ . '/vendor/autoload.php';
        ActiveRecord\Config::initialize(function($cfg) {
            $cfg->set_model_directory(__DIR__ . '/models');
            $cfg->set_connections(array(
                'development' => 'mysql://root:@localhost/sell;charset=utf8'
            ));
        });
    }

    public function addAdvice($content) {
        Advice::create(array(
            'content' => $content,
            'time' => new DateTime()
        ));
        return true;
    }

    public function getAdvices() {
        $result = array();
        foreach (Advice::all as $key => $value) {
            $result[$key] = array_intersect_key($value->to_array(), array_flip(array('content', 'time')));
        }
        return $result;
    }

}
