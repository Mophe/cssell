<?php

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

    public function modifyNotice($content) {
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

    public function getNotice() {
        $notice = Notice::first();
        $result = array_intersect_key($notice->to_array(), array_flip(array('content')));
        return $result;
    }

}
