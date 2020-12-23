<?php

namespace LSM\Controllers;

class IndexController
{
    public function __invoke()
    {
        // render the form
        require APP . 'views/index.php';
    }
}
