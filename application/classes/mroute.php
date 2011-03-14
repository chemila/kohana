<?php defined('SYSPATH') or die('No direct script access.');

class Mroute extends Route {

    public static function load()
    {
        $routes = Kohana::config(strtolower(__CLASS__));
        /**
         * Set the routes. Each route must have a minimum of a name, a URI and a set of
         * defaults for the URI.
            Route::set('default', '(<controller>(/<action>(/<id>)))')
                ->defaults(array(
                    'controller' => 'welcome',
                    'action'     => 'index',
            ));
         */
        foreach($routes as $name => $route)
        {
            Route::set($name, $route['uri'], $route['patterns'])->defaults($route['defaults']);
        }
    }
}
