<?php

// zzz: 02 - Controler

namespace Hidrometros;

use \App;
use \View;
use \Input;
use \Sentry;
use \Response;

class HidrometrosController {

    /**
     * display the admin dashboard
     */

    public function index() {
        View::display('hidrometros/index.twig', $this->data);
    }
}