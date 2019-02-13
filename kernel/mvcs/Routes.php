<?php

namespace Kernel\mvcs;

class Routes
{
    public static $routes;
    private static $routeNames;

    public function __construct($urlsMap)
    {
        self::setRoutes($urlsMap);
        self::setRouteNames();
    }

    public static function getRouteByName($routeName)
    {
        return array_filter(self::$routes, function ($k) use ($routeName) {
            return $k == $routeName;
        }, ARRAY_FILTER_USE_KEY);
    }

    public static function getPathByName($routeName)
    {
        $route = Routes::getRouteByName($routeName);

        return $route[$routeName][0];
    }

    public static function getRouteByPath($routePath)
    {
        return array_filter(self::$routes, function ($k, $v) use ($routePath) {
                return $k[0] == $routePath;
            }, ARRAY_FILTER_USE_BOTH) ?? null;
    }

    public static function setRoutes($routes)
    {
        self::$routes = $routes;
    }

    public static function setRouteNames()
    {
        self::$routeNames = array_keys(self::$routes);
    }
}