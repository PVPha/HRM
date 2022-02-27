<?php
spl_autoload_register(function ($class) {
    include_once('system/lib/' . $class . '.php');
});
include_once('app/config/config.php');
$main = new main();