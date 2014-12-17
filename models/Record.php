<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Record
 *
 * @author HJava
 */
class Record extends \ActiveRecord\Model {

    static $table_name = 'records';
    static $belongs_to = array(
        array('order'),
        array('commodity')
    );

}
