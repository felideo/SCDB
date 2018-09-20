<?php
namespace Controller;

use Libs;

class Painel_Controle extends \Framework\Controller {

	protected $modulo = [
		'modulo' 	=> 'painel_controle',
		'name'		=> 'Painel de Controle',
		'send'		=> 'Painel de Controle'
	];

	public function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();

		$this->view->assign('modulo', $this->modulo);
	}

	public function index(){
		$blame = $this->model->query
			->select('
				blame.*,
				trabalho.titulo,
				usuario.email,
				pessoa.nome,
				pessoa.sobrenome,
			')
			->from('blame_cadastro_trabalho blame')
			->leftJoin('trabalho trabalho ON trabalho.id = blame.id_trabalho')
			->leftJoin('usuario usuario ON usuario.id = blame.id_usuario AND usuario.ativo = 1')
			->leftJoin('pessoa pessoa ON pessoa.id_usuario = usuario.id AND pessoa.ativo = 1')
			->where('blame.ativo = 1')
			->orderBy('blame.data DESC')
			->limit(10)
			->fetchArray();

		// debug2($blame);

		foreach ($blame as &$trabalho){
			$trabalho['data'] = date("d/m/Y H:i:s", strtotime($trabalho['data']));

			switch ($trabalho['operacao']) {
				case 'Cadastro':
					$trabalho['cor_tag'] = 'label label-success';
					break;

				case 'Edição':
					$trabalho['cor_tag'] = 'label label-high';
					break;

				case 'Exclusão':
					$trabalho['cor_tag'] = 'label label-critical';
					break;

				case 'Aprovação':
					$trabalho['cor_tag'] = 'label label-normal';
					break;

				case 'Reprovação':
					$trabalho['cor_tag'] = 'label label-low';
					break;
			}
		}

		$trabalhos = $this->model->query
			->select('trabalho.titulo')
			->from('trabalho trabalho')
			->where('trabalho.status = 0 AND trabalho.ativo = 1')
			->fetchArray();

// debug2($blame);

		$this->view->assign('trabalhos_pendentes', $trabalhos);
		$this->view->assign('blame', $blame);


		$this->view->render('back/cabecalho_rodape_sidebar', $this->modulo['modulo'] . '/view/painel_controle');
	}
}