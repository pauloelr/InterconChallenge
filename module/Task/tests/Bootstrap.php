<?php
namespace Intercon\Challenge\TaskTest;

define('REQUEST_MICROTIME', microtime(true));

chdir(__DIR__);
$previousDir = '.';

while (!file_exists('config/application.config.php')) {
    $dir = dirname(getcwd());

    if ($previousDir === $dir) {
        throw new \RuntimeException(
            'Unable to locate "config/application.config.php": ' .
            'Is the Content module in a sub-directory of your application skeleton?'
        );
    }

    $previousDir = $dir;
    chdir($dir);
}

require 'vendor/autoload.php';

$config = require 'config/application.config.php';
$config['module_listener_options']['config_glob_paths'] = array('config/autoload/{,*.}{global,local,test}.php');
