<?php

namespace LSM\Controllers;

final class IndexController implements BaseController
{
    public function __invoke()
    {
        // render the form
        require APP . 'views/index.php';
    }
}
