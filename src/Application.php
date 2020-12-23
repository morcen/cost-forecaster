<?php

namespace LSM;

use LSM\Controllers\ForecastController;
use LSM\Controllers\IndexController;

class Application
{
    /**
     * @return string
     * @throws \Exception
     */
    public function run(): string | null
    {
        $uri = $_SERVER['REQUEST_URI'];

        switch ($uri) {
            case '/' && $_SERVER['REQUEST_METHOD'] === 'GET':
                return (new IndexController())();
            case '/compute'  && $_SERVER['REQUEST_METHOD'] === 'POST':
                $data = (array)json_decode(file_get_contents('php://input')) ?? $_POST;

                return (new ForecastController())($data);
        }

        header("HTTP/1.0 404 Not Found");
        echo '404 Route not found';
    }
}
