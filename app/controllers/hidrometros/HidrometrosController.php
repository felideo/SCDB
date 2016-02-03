<?php

// zzz: 02 - Controler

namespace Hidrometros ;

use \App;
use \View;
use \Menu;
use \Admin\BaseController;


class HidrometrosController extends BaseController {

    /**
     * display the admin dashboard
     */

    public function index() {
        View::display('hidrometros/index.twig');
    }
}