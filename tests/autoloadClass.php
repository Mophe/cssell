<?php

function autoloadClass($filename) {
    $filename = __DIR__ . "/../" . $filename . ".php";
    include_once($filename);
}

spl_autoload_register('autoloadClass');
