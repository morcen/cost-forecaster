<?php

namespace Forecost\Services;

use Forecost\Controllers\BaseController;
use Forecost\Controllers\ForecastController;
use Forecost\Controllers\IndexController;

class RouteService
{
    /**
     * @param  string  $uri
     * @param  string  $method
     * @return BaseController
     * @throws \Exception
     */
    public static function route(string $uri, string $method): BaseController
    {
        if ('/' === $uri && 'GET' === $method) {
            return new IndexController();
        }
        if ('/compute' === $uri && 'POST' === $method) {
            return new ForecastController();
        }

        throw new \Exception('Route not found', 404);
    }
}
