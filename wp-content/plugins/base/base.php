<?php
/*
Plugin Name: Base Theme Plugin
Plugin URI: https://github.com/kylephillips/wp-base-theme
Description: Various Items Required by the Base Theme
Version: 1.0.0
Author: Kyle Phillips
Author URI: https://github.com/kylephillips
License: GPL
*/
$loader = require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/app/Bootstrap.php');
$base_plugin = new Base\Bootstrap;