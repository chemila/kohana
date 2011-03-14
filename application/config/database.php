<?php defined('SYSPATH') or die('No direct access allowed.');

return array
(
	'default' => array
	(
		'type'       => 'mysql',
		'connection' => array(
			/**
			 * The following options are available for MySQL:
			 *
			 * string   hostname     server hostname, or socket
			 * string   database     database name
			 * string   username     database username
			 * string   password     database password
			 * boolean  persistent   use persistent connections?
			 *
			 * Ports and sockets may be appended to the hostname.
			 */
			'hostname'   => $_SERVER['SINASRV_DB_HOST'].':'.$_SERVER['SINASRV_DB_PORT'],
			'database'   => $_SERVER['SINASRV_DB_NAME'],
			'username'   => $_SERVER['SINASRV_DB_USER'],
			'password'   => $_SERVER['SINASRV_DB_PASS'],
			'persistent' => FALSE,
		),
		'table_prefix' => 'yule_',
		'charset'      => 'utf8',
		'caching'      => TRUE,
		'profiling'    => FALSE,
	),
	'alternate' => array(
		'type'       => 'mysql',
		'connection' => array(
			/**
			 * The following options are available for PDO:
			 *
			 * string   dsn         Data Source Name
			 * string   username    database username
			 * string   password    database password
			 * boolean  persistent  use persistent connections?
			 */
			'hostname'   => $_SERVER['SINASRV_DB_HOST_R'].':'.$_SERVER['SINASRV_DB_PORT_R'],
			'database'   => $_SERVER['SINASRV_DB_NAME_R'],
			'username'   => $_SERVER['SINASRV_DB_USER_R'],
			'password'   => $_SERVER['SINASRV_DB_PASS_R'],
			'persistent' => FALSE,
		),
		/**
		 * The following extra options are available for PDO:
		 *
		 * string   identifier  set the escaping identifier
		 */
		'table_prefix' => 'yule_',
		'charset'      => 'utf8',
		'caching'      => TRUE,
		'profiling'    => FALSE,
	),
);
