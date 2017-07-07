<?php
namespace Models;

use Libs;
use \Libs\QueryBuilder\QueryBuilder;
/**
* Classe Index_Model
*/
class Organismo_Model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function buscar_nome_popular($busca){
		$select = "SELECT nome, id"
			. " FROM"
			. " 	nome_popular"
			. " WHERE"
			. " 	nome LIKE '%{$busca['nome']}%'"
			. " AND ativo = 1";

			if(isset($busca['page_limit'])){
				$select .= " LIMIT {$busca['page_limit']}";
			}

		return $this->db->select($select);

		$query = $fpdo->from('article')
              ->leftJoin('user ON user.id = article.user_id')
              ->select('user.name');
	}

	public function carregar_organismo($id){

		$query = new QueryBuilder($this->db);


		$query->select('
			venda.*,
			item.*,
			variacao.*,
			produto.*
		')
		->from('venda_cadastro venda')
		->leftJoin('venda_produto_item item ON item.id_venda_cadastro = venda.id')
		->leftJoin('produto_variacao variacao ON variacao.id = item.id_produto_variacao')
		->leftJoin('produto_cadastro produto ON produto.id = variacao.id_produto_cadastro')
		->where('venda.id_instancia = "hcor"');


		// $query->select('
		// 	hhh.*,

		// 	rel_pop_name.id_nome_popular,
		// 	popular.nome,
		// 	geografica.latitude, geografica.longitude,
		// 	rel_imagem.id_arquivo,
		// 	imagem.hash, imagem.nome,
		// 	imagem.endereco,
		// 	imagem.extensao,

		// 	rel_trabalho.id,
		// 	rel_trabalho.id_organismo,
		// 	rel_trabalho.id_trabalho,
		// 	rel_trabalho.ativo,

		// 	trabalho_arquivo.hash,
		// 	trabalho_arquivo.nome,
		// 	trabalho_arquivo.endereco,
		// 	trabalho_arquivo.extensao,

		// 	trabalho.id,
		// 	trabalho.titulo,
		// 	trabalho.ano,
		// 	trabalho.resumo,
		// 	trabalho.link_trabalho,
		// 	trabalho.id_arquivo,
		// 	trabalho.id_idioma,
		// 	trabalho.id_autor,
		// 	trabalho.ativo,


		// 	idioma.idioma,
		// 	autor.nome,
		// 	autor.email,
		// 	autor.link,
		// 	rel_palavra.id_palavra_chave,
		// 	palavra.palavra_chave,
		// 	taxon.nome,
		// 	classificacao.nome


		// ')
		// ->from('organismo hhh')
		// ->leftJoin('organismo_relaciona_nome_popular rel_pop_name'
		// 		. ' ON rel_pop_name.id_organismo = hhh.id AND rel_pop_name.ativo = 1')
		// ->leftJoin('nome_popular popular'
		// 		. ' ON popular.id = rel_pop_name.id_nome_popular AND popular.ativo = 1')
		// ->leftJoin('posicao_geografica geografica'
		// 		. ' ON geografica.id_organismo = hhh.id AND geografica.ativo = 1')
		// ->leftJoin('organismo_relaciona_imagem rel_imagem'
		// 		. ' ON rel_imagem.id_organismo = hhh.id AND rel_imagem.ativo = 1 ')
		// ->leftJoin('arquivo imagem'
		// 		. ' ON imagem.id = rel_imagem.id_arquivo AND imagem.ativo = 1')
		// ->leftJoin('organismo_relaciona_trabalho rel_trabalho'
		// 		. ' ON rel_trabalho.id_organismo = hhh.id AND rel_trabalho.ativo = 1')


		// ->leftJoin('trabalho trabalho'
		// 		. ' ON trabalho.id = rel_trabalho.id_trabalho AND trabalho.ativo = 1')

		// ->leftJoin('arquivo trabalho_arquivo'
		// 		. ' ON trabalho_arquivo.id = trabalho.id_arquivo AND trabalho_arquivo.ativo = 1')



		// ->leftJoin('idioma idioma'
		// 		. ' ON idioma.id = trabalho.id_idioma AND idioma.ativo = 1')
		// ->leftJoin('autor autor'
		// 		. ' ON autor.id = trabalho.id_autor AND autor.ativo = 1')
		// ->leftJoin('trabalho_relaciona_palavra_chave rel_palavra'
		// 		. ' ON rel_palavra.id_trabalho = trabalho.id AND rel_palavra.ativo = 1')
		// ->leftJoin('palavra_chave palavra'
		// 		. ' ON palavra.id = rel_palavra.id_palavra_chave AND palavra.ativo = 1')
		// ->leftJoin('taxon taxon'
		// 		. ' ON taxon.id = hhh.id_last_taxon')
		// ->leftJoin('classificacao classificacao'
		// 		. ' ON classificacao.id = taxon.id_classificacao')
		// ->where("hhh.id = {$id}"
		// 	. " AND hhh.ativo = 1");


		return $query->fetchArray('first');



		// 		$query->select('
// 			v.id,
// 			v.id_alias,
// 			v.id_cliente_cadastro_endereco,
// 			v.desconto,
// 			v.data_faturamento,
// 			v.data,
// 			v.cupom,
// 			v.retirado_cliente,
// 			v.valor_total,
// 			v.frete_total,
// 			v.data_cadastro,
// 			v.tipo_frete,
// 			v.agendamento_entrega
// 		')
// 		->from('venda_cadastro v')
// 		->where('v.ativo = 1
// 			AND v.id >= ' . (2290613 - 1000));

// 		debug2($query->get_query());
// 		exit;

// debug2($query->fetchArray());
// exit;
	}
}
