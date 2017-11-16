<?php
namespace Model;

<<<<<<< HEAD
<<<<<<< HEAD:models/index_model.php
use Libs;

/**
* Classe Index_Model
*/
class Index_Model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}
=======
class Index extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function carregar_imagens_aleatorias(){
		return $this->get_query()
			->select('
				relacao.*,
				imagem.*
			')
			->from('organismo_relaciona_imagem relacao')
			->leftJoin('arquivo imagem ON imagem.id = relacao.id_arquivo')
			->where('relacao.ativo = 1')
			->orderBy('rand()')
			->limit(10)
			->fetchArray();
	}
>>>>>>> 262262a... DEV - FELIDEOMVC * reorganização de arquivos na nova estrutura * remoção de porcarias!:modulos/index/model/index.php
=======
class Index extends \Libs\Model{
>>>>>>> e90ea5e... DEV -SWDB * crud de autor * inicio de crud de trabalhos * alteração pasta de compilação de templates * removendo procaria inutil!
}

