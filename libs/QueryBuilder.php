<?php
namespace Libs\QueryBuilder;

class QueryBuilder {
	private $select;
	private $from;
	private $query;
	private $db;
	private $where            = [];
	private $leftJoin         = [];
	private $tables           = [];
	private $tables_x_alias   = [];
	private $join_on          = [];
	private $tree             = [];
	private $levels           = 0;
	private $join_on_by_level = [];
	private $tabelas_estrutura;


	public function __construct(){
		$this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
	}

	public function select($select){
		$select = explode(',', str_replace(' ', '', str_replace("\t", '', str_replace("\n", '', $select))));

		foreach ($select as $indice => $item) {
			$item = explode('.', $item);

			if(!isset($item[1]) || $item[1] == '*'){
				$selects = $this->try_get_select_columns($item[0]);

				if(!empty($selects)){
					$select = $this->process_select_all($item[0], $selects);
				}

				continue;
			}

			$select[] = $item[0] . '.' . $item[1] . ' AS ' . $item[0] . '__' . $item[1];
			$this->tables[$item[0]] = $item[0];
		}

		foreach ($this->tables as $indice => $item) {
			$select[] = $item . '.id AS ' . $item . '__' . 'id';
		}

		$this->select = implode(', ', $select);

		if(substr($this->select, -2) == ', '){
			$this->select = substr($this->select, 0, -2);
		}

		return $this;
	}

	public function from($from){
		$this->find_tables_name($from);
		$this->from = explode(' ', $from);

		$this->join_on[$this->from[0]] = [
			'from_table' => 0,
			'table'      => explode(' ', $from)[0]
		];

		return $this;
	}

	public function where($where){
		$this->where[] = $where;
		return $this;
	}

	public function leftJoin($leftJoin){
		$this->find_tables_name($leftJoin);
		$this->find_join_on($leftJoin);
		$this->leftJoin[] = $leftJoin;
		return $this;
	}

	public function rightJoin($rightJoin){
		$this->find_tables_name($rightJoin);
		$this->find_join_on($rightJoin);
		$this->leftJoin[] = $rightJoin;
		return $this;
	}

	public function innerJoin($innerJoin){
		$this->find_tables_name($innerJoin);
		$this->find_join_on($innerJoin);
		$this->leftJoin[] = $innerJoin;
		return $this;
	}

	private function get_columns_name($table){
		return $this->db->select("SELECT column_name FROM information_schema.columns WHERE table_name = '{$table}'");
	}

	private function try_get_select_columns($table){
		$columns = $this->get_columns_name($table);
		if (!empty($columns)) {
			$retorno = [];

			foreach ($columns as $indice => $column) {
				$retorno[] = $column['column_name'];
			}

			return $retorno;
		}
		return false;
	}

	private function process_select_all($table, array $selects){
		$retorno = [];

		foreach ($selects as $indice => $select) {
			$retorno[] = $table . '.' . $select . ' AS ' . $table . '__' . $select;
		}

		return $retorno;
	}





	private function find_tables_name($join){
		$join = trim(preg_replace('!\s+!', ' ', $join));
		$table = explode(' ', $join);
		$this->tables_x_alias[$table[1]] = trim($table[0]);
		return $table[0];
	}

	private function find_join_on($join){
		$join = preg_replace('!\s+!', ' ', explode('=', preg_split('/ on /i', $join)[1]));

		$join_table = trim(explode('.', trim($join[0]))[0]);
		$from_table = trim(explode('.', trim($join[1]))[0]);

		$this->join_on[$join_table] = [
			'from_table'  => $from_table,
			'table'       => $join_table,
		];
	}

	public function get_query(){
		// $select =
		// $this->query = str_replace("\t", '', str_replace("\n", '', $this->query));
		$this->build_query();
		return $this->query;
	}

	private function convertToTree(array $flat, $idField = 'table', $parentIdField = 'from_table'){
	    $indexed = array();

	    // first pass - get the array indexed by the primary id
	    foreach ($flat as $row) {
	        $indexed[$row[$idField]] = $row;
	    }

	    //second pass
	    $root = null;
	    foreach ($indexed as $id => $row) {
	        $indexed[$row[$parentIdField]][$id] =& $indexed[$id];

	        if (!$row[$parentIdField]) {
	            $root = $id;
	        }
	    }

	    return array($root => $indexed[$root]);
	}

	private function mount_structure(){
		$this->tabelas_estrutura = $this->join_on;
		$this->structure = $this->convertToTree($this->tabelas_estrutura);
	}

	private function get_primary_keys(){
		foreach ($this->join_on as $indice => &$table) {
			$table['primary'] = $this->db->select("SHOW KEYS FROM {$this->tables_x_alias[$table['table']]} WHERE Key_name = 'PRIMARY'")[0]['Column_name'];
		}
	}

	private function build_query(){
		// $this->mount_structure();



		if(!empty($this->select)){
			$this->query = 'SELECT ' . $this->select;
		}

		if(!empty($this->from)){
			$this->query .= ' FROM ' . $this->from[0] . ' ' . $this->from[1];
		}

		if(!empty($this->leftJoin)){
			$this->query .= " \nLEFT JOIN " . implode(" \nLEFT JOIN ", $this->leftJoin);
		}

		if(!empty($this->where)){
			$this->query .= ' WHERE ' . implode(' AND ', $this->where);
		}

		// debug2($this->query);

	}

	function array_merge_recursive_ex(array &$array1, array &$array2){
	    $merged = $array1;

	    foreach ($array2 as $key => & $value){
	        if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])){
	            $merged[$key] = $this->array_merge_recursive_ex($merged[$key], $value);
	        }elseif(is_numeric($key)){
	             if (!in_array($value, $merged)){
	                $merged[] = $value;
	             }
	        }else{
	            $merged[$key] = $value;
	        }
	    }

	    return $merged;
	}

	private function get_altura_nos(){
		$join_on = [];

		while (count($join_on) != count($this->join_on)) {
			foreach ($this->join_on as $indice => $table) {
				if(isset($join_on[$indice])){
					continue;
				}

				if(empty($table['from_table'])){
					$join_on[$indice]          = $table;
					$join_on[$indice]['level'] = 0;
					continue;
				}

				if(isset($join_on[$table['from_table']]['level'])){
					$join_on[$indice]          = $table;
					$join_on[$indice]['level'] = $join_on[$table['from_table']]['level'] + 1;

					if($join_on[$indice]['level'] > $this->levels){
						$this->levels = $join_on[$indice]['level'];
					}

					continue;
				}
			}
		}

		$this->join_on = $join_on;
	}

	private function porColuna(&$array, $coluna, $direcao = 'asc') {
		if ($direcao != 'asc' && $direcao != 'desc') {
			$direcao = 'asc';
		}
	    $newarr = null;
	    $sortcol = array();
	    foreach ($array as $a) {
	        $sortcol[$a[$coluna]][] = $a;
	    };
	    ksort($sortcol);
	    foreach ($sortcol as $col) {
	        foreach ($col as $row)
	            $newarr[] = $row;
	    }

	    if ($direcao == 'desc')
	        if ($newarr) {
	            $array = array_reverse($newarr);
	        } else {
	            $array = $newarr;
	        } else
	        $array = $newarr;

	    return is_null($array) ? [] : $array;
	}


	public function fetchArray(){
		$retorno =  $this->db->select($this->get_query());

		$this->get_primary_keys();
		$this->get_altura_nos();
		$this->tree = $this->convertToTree($this->join_on);
		$this->join_on_by_level = $this->join_on;
		$this->porColuna($this->join_on_by_level, 'level', 'desc');



		// debug2($this->join_on);
		// exit;


		// debug2($this->levels);
		// debug2($this->join_on);
		// debug2($this->tree);

		$alias = [];

		foreach ($retorno[0] as $indice => $item) {
			$selected_alias = explode('__', $indice)[0];
			$alias[$selected_alias] = $selected_alias;
		}



		$ordenado_por_tabela = [];
		$ordenado_por_arvore = [];

		foreach ($retorno as $indice_01 => $tabela) {
			$primary_from = $this->from[1] . '__' . $this->join_on[$this->from[1]]['primary'];

			foreach ($tabela as $indice_02 => $coluna) {
				$tabela_x_coluna = explode('__', $indice_02);

				$primary = $tabela_x_coluna[0] . '__' . $this->join_on[$tabela_x_coluna[0]]['primary'];

				if(!empty($this->join_on[$tabela_x_coluna[0]]['from_table'])){
					$foreign = $this->join_on[$this->join_on[$tabela_x_coluna[0]]['from_table']]['table'] . '__' . $this->join_on[$this->join_on[$tabela_x_coluna[0]]['from_table']]['primary'];
				}

				$ordenado_por_tabela[$tabela_x_coluna[0]][$tabela[$primary_from] . '__' . $tabela[$primary]][$tabela_x_coluna[1]]  = $coluna;
				$ordenado_por_tabela[$tabela_x_coluna[0]][$tabela[$primary_from] . '__' . $tabela[$primary]]['join_on']            = $this->join_on[$tabela_x_coluna[0]];
				$ordenado_por_tabela[$tabela_x_coluna[0]][$tabela[$primary_from] . '__' . $tabela[$primary]]['join_on']['primary'] = $tabela[$primary];
 				$ordenado_por_tabela[$tabela_x_coluna[0]][$tabela[$primary_from] . '__' . $tabela[$primary]]['join_on']['foreign']      = isset($foreign) ? $tabela[$foreign] : null;
 				$ordenado_por_tabela[$tabela_x_coluna[0]][$tabela[$primary_from] . '__' . $tabela[$primary]]['join_on']['primary_from'] = $tabela[$primary_from];
			}
		}
		// debug2($ordenado_por_tabela);

		foreach($this->join_on_by_level as $indice => $level) {
			foreach ($ordenado_por_tabela[$level['table']] as $tabela => $resultado){

				$index = $resultado['join_on']['primary_from'] . '__' . $resultado['join_on']['foreign'];

				$tabela_join = $resultado['join_on']['table'];
				unset($resultado['join_on']);

				$ordenado_por_tabela[$level['from_table']][$index][$tabela_join][] = $resultado;


			}

			unset($ordenado_por_tabela[$level['table']]);
		}

		$ordenado_por_tabela = $ordenado = $this->replaceKey($ordenado_por_tabela);

    	debug2(array_values($ordenado_por_tabela[0]));
    	exit;





			debug2($primary_from);

		debug2($this->from[1]);
		debug2($this->join_on[$this->from[1]]['primary']);
			debug2($tabela);
		exit;
			debug2($this->join_on);
			exit;

			// foreach ($ordenado_por_tabela[$indice_01] as $indice_02 => $tabela) {
			// 	if($indice_02 == $this->from[1]){
			// 		$ordenado_por_tabela[$indice_01][$indice_02] = $tabela;
			// 		continue;
			// 	}

			// 	unset($ordenado_por_tabela[$indice_01][$indice_02]);
			// 	$ordenado_por_tabela[$indice_01][$indice_02][$tabela['id']] = $tabela;
			// }


			foreach ($this->join_on as $indice_03 => $join_on) {
				$ordenado_por_tabela[$indice_01][$indice_03] += $join_on;
			}


			$arborizado[$indice_01] = $this->convertToTree($ordenado_por_tabela[$indice_01])[$this->from[1]];




		$this->remover_origens($arborizado);

		debug2($arborizado);
		exit;

		$separado = [];

		foreach ($arborizado as $indice_01 => $arvore) {
			$separado[$arvore['id']][] = $arvore;
		}

		$zzz = [];

		foreach ($separado as $indice => $lerolero){
			$zzz[$indice] = [];

			for($i = 0; $i <= 10; $i = $i + 2){
				$zzz[$indice] = array_merge_recursive($zzz[$indice], $lerolero[$i + 1]);
			}
		}

		debug2($zzz);
		exit;


		debug2($arborizado);
		exit;

		$merge = [];


		// }




			debug2($merge);
			exit;

			$ordenado = $this->replaceKey($ordenado);

			$ultimo[$itens[0][$this->from[0] . '__id']] = $ordenado;

			unset($refinado);

		return array_values($ultimo);
	}

	private function merge_array($array){
		foreach ($array as $indice_01 => $arvore) {
			$this->merge[$arvore['id']][] = $arvore;

			// foreach($arvore as $indice_02 => $tabela) {
			// 	if(!is_array($tabela)){
			// 		continue;
			// 	}

			// 	debug2($tabela);
			// 	exit;

			// 	$merge[$arvore['id']][$indice_02] = array_merge($merge[$arvore['id']][$indice_02], $tabela);

			// 	debug2($merge[$arvore['id']]);
			// 	exit;

			// 	if(isset($merge['id'][$indice_02])){
			// 		$merge['id'][$indice_02][] = $tabela;
			// 		continue;
			// 	}

			// 	$merge['id'][$indice_02] = $tabela;
			}
	}

	// public function fetchArray(){
	// 	$retorno =  $this->db->select($this->get_query());

	// 	$alias = [];

	// 	foreach ($retorno[0] as $indice => $item) {
	// 		$selected_alias = explode('__', $indice)[0];
	// 		$alias[$selected_alias] = $selected_alias;
	// 	}

	// 	foreach ($retorno as $indice => $item) {
	// 		$tratamento[$item[$this->from[0] . '__id']][] = $item;
	// 	}

	// 	// debug2($tratamento);

	// 	foreach ($tratamento as $indice_01 => $itens) {
	// 		foreach ($itens as $indice_02 => $item) {
	// 			foreach ($item as $indice_03 => $val) {
	// 				$name_value = explode('__', $indice_03);
	// 				$tratados[$name_value[0]][$name_value[1]] = $val;
	// 			}

	// 			foreach ($tratados as $indice_03 => $tratado) {
	// 				if(empty($tratado['id'])){
	// 					$refinado[$indice_03] = [];
	// 					$refinado[$indice_03] += $this->join_on[$indice_03];
	// 					continue;
	// 				}

	// 				$refinado[$indice_03][$tratado['id']] = $tratado;
	// 				$refinado[$indice_03] += $this->join_on[$indice_03];
	// 			}
	// 		}

	// 		$ordenado = $this->convertToTree($refinado);
	// 		$this->remover_origens($ordenado);
	// 		$ordenado = $this->replaceKey($ordenado);

	// 		$ultimo[$itens[0][$this->from[0] . '__id']] = $ordenado;

	// 		unset($refinado);
	// 	}

	// 	return array_values($ultimo);
	// }

	private function remover_origens(&$variavel){
		unset($variavel['from_table']);
		unset($variavel['table']);

		foreach($variavel as &$item) {
			if(is_array($item)){
				$this->remover_origens($item);
			}
		}
	}

	private function replaceKey($array) {
	    if(!is_array($array)){
	    	return $array;
	    }

    	$array_values = 0;
    	$new_array = [];

	    	foreach($array as $indice_01 => $value) {
	    		if(is_numeric($indice_01)){
	    			$new_array[$array_values] = $value;
	    			$array_values++;
	    		}else{
	    			$new_array[$indice_01] = $value;
	    		}

	    	}

	    $novo_array = array();

	    foreach ($new_array as $indice => $item) {
	    	$novo_indice = isset($this->tables_x_alias[$indice]) ? $this->tables_x_alias[$indice] : $indice;
	        $novo_array[$novo_indice] = $this->replaceKey($item);
	    }

	    return $novo_array;
	}
}

