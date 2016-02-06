<?php

Class HomeController extends BaseController
{

    public function welcome()
    {
        $this->data['title'] = 'Welcome to Slim Starter Application';
        App::render('welcome.twig', $this->data);
    }

     public function buceta() {

    	echo "lerolero";
    	// if(!$page){
        //     App::render('docs/index.twig', $this->data);
        // }else{
        //     $page = 'docs/'.implode('/', $page).'.twig';
        //     App::render($page, $this->data);
        // }
    }
}