<?php
namespace Controllers;

use Libs;

class Painel_Controle extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'painel_controle',
		'name'		=> 'Painel de Controle',
		'send'		=> 'Painel de Controle'
	];

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();

		$this->view->modulo = $this->modulo;


		$this->view->js = array('/dashboard/js/default.js');
	}

	function index() {
		$this->view->render($this->modulo['modulo'] . '/' . $this->modulo['modulo']);
	}

	function logout() {
		\Libs\Session::destroy();
		header('location: '. URL .'login');
		exit;
	}

	function xhrInsert() {
		echo 'lerolero';
		$this->model->xhrInsert();
	}

	function xhrGetListings() {
		$this->model->xhrGetListings();
	}

	function xhrDeleteListing() {
		$this->model->xhrDeleteListing();
	}

	function cu(){

		debug2('Lerolero');

		echo '<h1>Simple Mail</h1>';
		/* @var SimpleMail $mail */
		$mail = new \Libs\SimpleMail();
		$mail->setTo('felideo@gmail.com', 'Recipient 1')
		     ->setSubject('Test Message')
		     ->setFrom('sender@gmail.com', 'Mail Bot')
		     ->addMailHeader('Reply-To', 'sender@gmail.com', 'Mail Bot')
		     ->addMailHeader('Cc', 'bill@example.com', 'Bill Gates')
		     ->addMailHeader('Bcc', 'steve@example.com', 'Steve Jobs')
		     ->addGenericHeader('X-Mailer', 'PHP/' . phpversion())
		     ->addGenericHeader('Content-Type', 'text/html; charset="utf-8"')
		     ->setMessage('<strong>This is a test message.</strong>')
		     ->setWrap(78);


		$send = $mail->send();
		echo $mail->debug();
		if ($send) {
		    echo 'Email was sent successfully!';
		} else {
		    echo 'An error occurred. We could not send email';
		}
		exit;
	}

}