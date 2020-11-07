<?php

/*
  Plugin Name: Reshatel Order Viewer
  Description: Просмотр заказа ЛК.
  Version: 0.1
  Author: Rusty Shackleford
 */

/*  Copyright 2018  Rusty Shackleford

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

$rv_config = json_decode(file_get_contents(__DIR__ . '/config.json'));

include_once 'ROV.php';

$rv_object = new ROV($rv_config->db);
$rv_object->run();
