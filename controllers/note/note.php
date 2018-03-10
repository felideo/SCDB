<?php
namespace Controllers;

use Libs;

/**
*
*/
class Note extends \Libs\Controller
{


	public function __construct()
	{
		parent::__construct();
		\Util\Auth::handLeLoggin();
		\Util\Permission::check();

		$this->view->js = array('/dashboard/js/default.js');
	}

	public function index()
	{
		$this->view->noteList = $this->model->noteList();

		$this->view->render('note');

	}

	public function create()
	{
		$data = array(
			'title' => $_POST['title'],
			'content' => $_POST['content']
		);

		$this->model->create($data);
		header('location: ' . URL . 'note');
	}

	public function edit($id)
	{
		$this->view->note = $this->model->noteSingleList($id);

		$this->view->sub_render('note', 'edit');

	}

	public function editSave($noteid)
	{
		$data = array(
			'noteid' => $noteid,
			'title' => $_POST['title'],
			'content' => $_POST['content']
		);

		// @TODO: Faça seu error checking!



		$this->model->editSave($data);


		header('location: ' . URL . 'note');
	}

	public function delete($id)
	{
		$this->model->delete($id);
		header('location: ' . URL . 'note');


	}


}