<?php

session_start();

function autoloadClass($filename) {
    $filename = "./" . $filename . ".php";
    include_once($filename);
}

function login() {
    $args = filter_input_array(INPUT_GET, array(
        'username' => FILTER_DEFAULT,
        'password' => FILTER_DEFAULT
    ));
    if ($args === false || count(array_filter($args, function ($item) {
                        return $item === false || $item === null;
                    })) !== 0) {
        throw new Exception('args error');
    }
    $user = new CoreUser();
    if ($user->login($args['username'], $args['password'])) {
        return array();
    } else {
        throw new Exception('Username or Password Error');
    }
}

function checkLogin() {
    $user = new CoreUser();
    if ($user->checkLogin()) {
        return array();
    } else {
        throw new Exception('no login');
    }
}

function addUser() {
    $args = filter_input_array(INPUT_POST, array(
        'username' => FILTER_DEFAULT,
        'password' => FILTER_DEFAULT
    ));
    if ($args === false || count(array_filter($args, function ($item) {
                        return $item === false || $item === null;
                    })) !== 0) {
        throw new Exception('args error');
    }
    $user = new CoreUser();
    if ($user->addUser($args['username'], $args['password'])) {
        return array();
    } else {
        throw new Exception('Add User Error');
    }
}

function deleteUser() {
    $args = filter_input_array(INPUT_POST, array(
        'username' => FILTER_DEFAULT
    ));
    if ($args === false || count(array_filter($args, function ($item) {
                        return $item === false || $item === null;
                    })) !== 0) {
        throw new Exception('args error');
    }
    $user = new CoreUser();
    if ($user->deleteUser($args['username'])) {
        return array();
    } else {
        throw new Exception('no user exist');
    }
}

function getCommidities() {
    $commodity = new CoreCommodity();
    return $commodity->getCommodities();
}

function addCommodity() {
    $args = filter_input_array(INPUT_POST, array(
        'name' => FILTER_DEFAULT,
        'price' => FILTER_DEFAULT,
    ));
    if ($args === false || count(array_filter($args, function ($item) {
                        return $item === false || $item === null;
                    })) !== 0) {
        throw new Exception('args error');
    }
    $commodity = new CoreCommodity();
    if ($commodity->addCommodity($args['name'], $args['price'], $args['introduction'])) {
        return array();
    } else {
        throw new Exception('Add Commodity Error');
    }
}

function deleteCommodity() {
    $args = filter_input_array(INPUT_POST, array(
        'name' => FILTER_DEFAULT
    ));
    if ($args === false || count(array_filter($args, function ($item) {
                        return $item === false || $item === null;
                    })) !== 0) {
        throw new Exception('args error');
    }
    $commodity = new CoreCommodity();
    if ($commodity->deleteCommodity($args['name'])) {
        return array();
    } else {
        throw new Exception('no exist commodity');
    }
}

function addRecord() {
    $args = filter_input_array(INPUT_POST, array(
        'commodities' => FILTER_DEFAULT,
    ));
    if ($args === false || count(array_filter($args, function ($item) {
                        return $item === false || $item === null;
                    })) !== 0) {
        throw new Exception('args error');
    }
    $record = new CoreRecord();
    if ($record->addRecord($args['commodities'])) {
        return array();
    } else {
        throw new Exception('Add Record Error');
    }
}

function countMoney() {
    $args = filter_input_array(INPUT_POST, array(
        'start' => FILTER_DEFAULT,
        'end' => FILTER_DEFAULT
    ));
    if ($args === false || count(array_filter($args, function ($item) {
                        return $item === false || $item === null;
                    })) !== 0) {
        throw new Exception('args error');
    }
    $record = new CoreRecord();
    return array('price' => $record->countMoney($args['start'], $args['end']));
}

try {
    spl_autoload_register('autoloadClass');
    $method = filter_input(INPUT_GET, 'method');
    if (function_exists($method)) {
        require __DIR__ . '/vendor/autoload.php';
        ActiveRecord\Config::initialize(function($cfg) {
            $cfg->set_model_directory('models');
            $cfg->set_connections(array(
                'development' => 'mysql://root:@localhost/sell;charset=utf8'
            ));
        });
        $result = call_user_func($method);
    } else {
        throw new Exception('not method');
    }
    echo json_encode(array_merge(array('result' => true), $result));
} catch (Exception $ex) {
    echo json_encode(array('result' => false, 'msg' => $ex->getMessage()));
}