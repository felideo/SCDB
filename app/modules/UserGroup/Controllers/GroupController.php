<?php

namespace UserGroup\Controllers;

use \App;
use \View;
use \Menu;
use \Admin\BaseController;

class GroupController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        Menu::get('admin_sidebar')->setActiveMenu('group');
    }

    public function index() {
        $lerolero = "Puta que o pariu!!!";
        debug2($lerolero);
        $this->data['title'] = 'Group List';
        /** render the template */
        View::display('@usergroup/group/index.twig', $this->data);
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

    public function lerolero(){
        $numero = 9;
        echo $numero;
    }
}