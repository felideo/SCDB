<?php
namespace Controllers;

use Libs;

class ajax_upload extends \Libs\Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index() {
	}

	public function upload() {
		// debug2($_POST);
		// debug2($_GET);
		// debug2($_FILES);

		// else do regular POST upload (i.e. for old non-HTML5 browsers)
		$size = $_FILES['qqfile']['size'];

		if ($size == 0) {
			return array('error' => 'File is empty.');
		}

		$pathinfo   = pathinfo($_FILES['qqfile']['name']);
		$filename   = $pathinfo['filename'];
		$ext        = @$pathinfo['extension'];
		$ext        = ($ext == '') ? $ext : '.' . $ext;
		$hash       = \Util\Hash::get_unic_hash();
		$uploadname = $hash . $ext;

		if (!move_uploaded_file($_FILES['qqfile']['tmp_name'], 'uploads/' . $_POST['local'] . '/' . $uploadname)) {
			$results = array('error' => 'Could not save upload file.');
		} else {
			@chmod($tempfilepath, 0644);

			$insert_db = [
				'hash'     => $hash,
				'nome'     => $filename,
				'endereco' => 'uploads/' . $_POST['local'] . '/' . $hash . $ext,
				'tamanho'  => (float) $size / 1000000,
				'extensao' => $ext

			];

			$retorno_arquivo = $this->model->get_insert('arquivo', $insert_db);

			$results = array('success' => true);
			$results = array_merge($results, array_merge($insert_db, $retorno_arquivo));
		}

		ob_clean();

		echo json_encode($results); // returns JSON
		exit;
	// return $results; // returns JSON
	}
}
