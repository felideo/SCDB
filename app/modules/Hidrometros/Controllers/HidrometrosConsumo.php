<?php

namespace Hidrometros\Controllers;

use \App;
use \View;
use \Menu;
use \Admin\BaseController;

class HidrometrosConsumo extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        Menu::get('admin_sidebar')->setActiveMenu('consumo');
    }

    public function index()
    {
        $this->data['title'] = 'Hidrometros de Consumo';
        /** render the template */
        View::display('@hidrometros/consumo/index.twig', $this->data);
    }

    public function show()
    {

    }

    public function store()
    {

    }

    public function create()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}