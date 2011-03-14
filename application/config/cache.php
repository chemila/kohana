<?php defined('SYSPATH') or die('No direct script access.');
return array
(
	'memcache' => array
	(
		'driver'             => 'memcache',
		'default_expire'     => 3600,
		'compression'        => FALSE,              // Use Zlib compression (can cause issues with integers)
		'servers'            => array
		(
			array
			(
				'host'             => $_SERVER['SINASRV_MEMCACHED_HOST'],  // Memcache Server
				'port'             => $_SERVER['SINASRV_MEMCACHED_PORT'],  // Memcache port number
				'persistent'       => FALSE,        // Persistent connection
				'weight'           => 1,
				'timeout'          => 1,
				'retry_interval'   => 15,
				'status'           => TRUE,
			),
		),
		'instant_death'      => TRUE,               // Take server offline immediately on first fail (no retry)
	),
	'memcachetag' => array
	(
		'driver'             => 'memcachetag',
		'default_expire'     => 3600,
		'compression'        => FALSE,              // Use Zlib compression (can cause issues with integers)
		'servers'            => array
		(
			array
			(
				'host'             => $_SERVER['SINASRV_MEMCACHED_HOST'],  // Memcache Server
				'port'             => $_SERVER['SINASRV_MEMCACHED_PORT'],  // Memcache port number
				'persistent'       => FALSE,        // Persistent connection
				'weight'           => 1,
				'timeout'          => 1,
				'retry_interval'   => 15,
				'status'           => TRUE,
			),
		),
		'instant_death'      => TRUE,
	),
	'apc'      => array
	(
		'driver'             => 'apc',
		'default_expire'     => 3600,
	),
	'eaccelerator'           => array
	(
		'driver'             => 'eaccelerator',
	),
	'xcache'   => array
	(
		'driver'             => 'xcache',
		'default_expire'     => 3600,
	),
	'file'    => array
	(
		'drivers'             => 'file',
		'cache_dir'          => $_SERVER['SINASRV_CACHE_DIR'],
		'default_expire'     => 3600,
	)
);

