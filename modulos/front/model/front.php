<?php
namespace Model;

use Libs;

class Front extends \Framework\Model{
	public function carregar_paginas_institucionais(){
		return $this->query
			->select('
				pagina.id,
				pagina.titulo,
				pagina.exibir_cabecalho,
				pagina.exibir_rodape,
				url.url,
				url.controller
			')
			->from('pagina_institucional pagina')
			->leftJoin("url url ON url.id_controller = pagina.id AND url.controller = 'pagina_institucional' AND url.ativo = 1")
			->where('pagina.ativo = 1')
			->fetchArray();
	}
}