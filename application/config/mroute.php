<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 * Route::set('default', '(<controller>(/<action>(/<id>)))')
 *    ->defaults(array(
 *        'controller' => 'welcome',
 *        'action'     => 'index',
 *        'action'     => 'index',
 *    ));
 */
return array
(
    'welcomes' => array(
        'uri' => 'welcome(/<action>(/<id>))',
        'patterns' => array(
            'id' => '\d+',
        ),
        'defaults' => array('controller' => 'welcome', 'action' => 'index'),
    ),
    'admin' => array(
        'uri' => 'admin(/<action>)',
        'patterns' => array(),
        'defaults' => array('controller' => 'admin', 'action' => 'index'),
    ),
    'manage' => array(
        'uri' => 'manage(/<action>(/<type>))',
        'patterns' => array(),
        'defaults' => array('controller' => 'manage', 'action' => 'index'),
    ),
    'cron' => array(
        'uri' => 'cron(/<action>(/<name>))',
        'patterns' => array('name' => '[1-9\pL\pN]+'),
        'defaults' => array('controller' => 'cron', 'action' => 'index'),
    ),
    'top' => array(
        'uri' => 'top(/<action>(/<name>))',
        'patterns' => array('name' => '[1-9\pL\pN]+'),
        'defaults' => array('controller' => 'top', 'action' => 'index'),
    ),
    'category' => array(
        'uri' => 'category(/<action>(/<name>(/<page>)))',
        'patterns' => array('page' => '\d+'),
        'defaults' => array('controller' => 'category', 'action' => 'index'),
    ),
    'search' => array(
        'uri' => 'search(/<action>(/<page>))',
        'patterns' => array('page' => '\d+'),
        'defaults' => array('controller' => 'search', 'action' => 'index'),
    ),
    'default' => array(
        'uri' => '(<controller>(/<action>))',
        'patterns' => array(),
        'defaults' => array('controller' => 'welcome', 'action' => 'index'),
    ),
);
