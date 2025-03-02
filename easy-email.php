<?php
/*

Plugin Name: Easy Email
Plugin URI: https://wpeasyemail.com/
Description: Easily send emails from WordPres. No SMTP required! Fast and easy setup.
Version: 1.0.4
Author: Wicked Plugins
Text Domain: easy-email
License: GPLv2 or later

Copyright 2024 Driven Development, LLC dba Easy Email
(email : info@drivendevelopment.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

// Disable direct load
if ( ! defined( 'ABSPATH' ) ) exit;

include( 'autoload.php' );
include( 'classes/plugin.php' );

Easy_Email\Plugin::get_instance();