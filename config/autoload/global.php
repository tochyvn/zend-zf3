<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
    'db' => [
        'driver' => 'Pdo',
        'dsn'    => 'mysql:dbname=zf-tutorial;host=127.0.0.1;charset=utf8',
        'username' => 'root',
        'password' => ''
    ],

    'sphinx' => [
    	'driver'    => 'pdo_mysql',
	    'hostname'  => '127.0.0.1',
	    'port'      => 9306,
	    'charset'   => 'UTF8'
    ],
];
