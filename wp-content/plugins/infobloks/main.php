<?php
/*
  Plugin Name: Infoblocks
  Plugin URI: https://github.com/antonka/infobloks
  Description: Позволяет создавать независимые блоки информации на сайте.
  Version: 1.0.1
  Author: Anton Karamnov 
  Author URI: https://github.com/antonka
 */

if(!defined('INFOBLOCKS_DIR'))
	define('INFOBLOCKS_DIR',dirname(__FILE__));

// File Install Plugin
require INFOBLOCKS_DIR.DIRECTORY_SEPARATOR.'install.php';

// Back-end
if(is_admin())
{	
	require INFOBLOCKS_DIR.DIRECTORY_SEPARATOR.'backend.php';
}
// Front-end
else
{
	require INFOBLOCKS_DIR.DIRECTORY_SEPARATOR.'libraries'.DIRECTORY_SEPARATOR.'infoblock.php';
}


