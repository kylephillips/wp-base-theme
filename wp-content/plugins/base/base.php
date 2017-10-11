<?php
/*
Plugin Name: Base Theme Plugin
Plugin URI: https://github.com/kylephillips/wp-base-theme
Description: Various Items Required by the Base Theme
Version: 1.0
Author: Kyle Phillips
Author URI: https://github.com/kylephillips
License: GPL
*/
$loader = require_once 'vendor/autoload.php';
require_once('app/Bootstrap.php');
$base_plugin = new Base\Bootstrap;