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
            'icon'  => 'clock-o',
            'url'   => '#'
        ));
        $hidrometros_menu->setAttribute('class', 'nav nav-second-level');

        $hidrometros_controle = $adminMenu->createItem('controle', array(
            'label' => 'Controle',
            'icon'  => 'history',
            'url'   => 'admin/controle'
        ));

        $hidrometros_consumo = $adminMenu->createItem('consumo', array(
            'label' => 'Consumo',
            'icon'  => 'history',
            'url'   => 'admin/consumo'
        ));

        $hidrometros_menu->addChildren($hidrometros_controle);
        $hidrometros_menu->addChildren($hidrometros_consumo);

        $adminMenu->addItem('hidrometros', $hidrometros_menu);
    }

    public function registerAdminRoute(){
        Route::resource('/controle', 'Hidrometros\Controllers\Controle');
        Route::resource('/consumo', 'Hidrometros\Controllers\Consumo');
        Route::post('/controle/zzz', 'Hidrometros\Controllers\Controle:adicionar_hidrometro');

    }
}