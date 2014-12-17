<?php

class CoreUser {

    function __construct() {
        require __DIR__ . '/vendor/autoload.php';
        ActiveRecord\Config::initialize(function($cfg) {
            $cfg->set_model_directory(__DIR__ . '/models');
            $cfg->set_connections(array(
                'development' => 'mysql://root:@localhost/sell;charset=utf8'
            ));
        });
    }

    public function login($username, $password) {
        $user = User::first(array('username' => $username));
        if ($user && $user->password === md5($password . $user->salt)) {
            $_SESSION['username'] = $username;
            return true;
        } else {
            return false;
        }
    }

    public function checkLogin() {
        if (!isset($_SESSION['username'])) {
            return false;
        }
        return true;
    }

    public function addUser($username, $password) {
        $user = User::first(array('username' => $username));
        if ($user === null) {
            $salt = $this->createSalt(4);
            User::create(array(
                'username' => $username,
                'password' => md5($password . $salt),
                'salt' => $salt
            ));
            return true;
        } else {
            return false;
        }
    }

    function createSalt($length = 4) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_ []{}<>~`+=,.;:/?|';
        $salt = '';
        for ($i = 0; $i < $length; $i++) {
            $salt .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $salt;
    }

    public function deleteUser($username) {
        $user = User::first(array('username' => $username));
        if ($user !== null) {
            $user->delete();
            return true;
        } else {
            return false;
        }
    }

    function getUsers() {
        $result = array();
        foreach (User::all() as $key => $value) {
            $result[$key] = array_intersect_key($value->to_array(), array_flip(array('username')));
        }
        return $result;
    }

}
