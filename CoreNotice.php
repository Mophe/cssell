<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CoreNotice
 *
 * @author HJava
 */
class CoreNotice {

    function __construct() {
        require __DIR__ . '/vendor/autoload.php';
        ActiveRecord\Config::initialize(function($cfg) {
            $cfg->set_model_directory(__DIR__ . '/models');
            $cfg->set_connections(array(
                'development' => 'mysql://root:@localhost/sell;charset=utf8'
            ));
        });
    }

    /**
     *
     * @param type $start
     * @param type $end
     * @param type $content
     * @return boolean
     *
     * @assert ('haha') == true
     * @assert ('hehe') == true
     */
    public function changeNotice($content) {
        $notice = Notice::first();
        if ($notice === null) {
            Notice::create(array(
                'content' => $content,
            ));
        } else {
            $notice->update_attribute('content', $content);
        }
        return true;
    }

    /**
     *
     * @return type
     */
    public function getNotice() {
        $notice = Notice::first();
        $result = array_intersect_key($notice->to_array(), array_flip(array('content')));
        return $result;
    }

}
