<?php

namespace Hidrometros;

use \App;
use \Menu;
use \Route;

class Initialize extends \SlimStarter\Module\Initializer{

    public function getModuleName(){
        return 'Hidrometros';
    }

    public function getModuleAccessor(){
        return 'hidrometros';
    }

    public function registerAdminMenu(){

        $adminMenu = Menu::get('admin_sidebar');

        $hidrometros_menu = $adminMenu->createItem('hidrometros', array(
            'label' => 'Hidrometros',
            'icon'  => 'group',
            'url'   => '#'
        ));
        $hidrometros_menu->setAttribute('class', 'nav nav-second-level');

        $hidrometros_controle = $adminMenu->createItem('user', array(
            'label' => 'Controle',
            'icon'  => 'user',
            'url'   => 'hidrometros/controle'
        ));

        $hidrometros_consumo = $adminMenu->createItem('group', array(
            'label' => 'Consumo',
            'icon'  => 'group',
            'url'   => 'hidrometros/consumo'
        ));

        $hidrometros_menu->addChildren($hidrometros_controle);
        $hidrometros_menu->addChildren($hidrometros_consumo);

        $adminMenu->addItem('hidrometros', $hidrometros_menu);
    }

    public function registerAdminRoute(){
        Route::resource('/controle', 'Hidrometros\Controllers\hidrometros_controle');
        Route::resource('/consumo', 'Hidrometros\Controllers\HidrometrosConsumo');
    }
}