<?php


namespace LSM\Services;


use LSM\Controllers\IndexController;

class RouteService
{
    public function __construct(private string $uri)
    {
    }

    private function routes()
    {
        return [
            'POST' => [
                'compute' => (new IndexController())()
            ],
            'GET' => [
                '/'
            ]
        ];
    }
}
