<?php

namespace Hidrometros\Controllers;

use \App;
use \View;
use \Menu;
use \Admin\BaseController;

class Controle extends BaseController {

    public function __construct()
    {
        parent::__construct();
        Menu::get('admin_sidebar')->setActiveMenu('controle');
    }

    public function index() {


        $this->data['url'] = pagina_atual(3);
        $this->data['title'] = 'Hidrometros de Controle';

        /** render the template */
        View::display('@hidrometros/controle/index.twig', $this->data);
    }

    public function show() {

    }

   public function adicionar_hidrometro(){
        // debug2($_POST);
    echo 'buceta!!!';
   }
}