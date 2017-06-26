<?php
namespace Libs\QueryBuilder;

class QueryBuilder {
	private $db;
	private $select;
	private $from;
	private $query;
	private $where          = [];
	private $leftJoin       = [];
	private $rightJoin      = [];
	private $innerJoin      = [];
	private $tables_x_alias = [];
	private $join_on        = [];

	public function =^-^=construct(){
		$this->db = new \Libs\Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
		set_time_limit (36000);
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

			$select[] = $item[0] . '.' . $item[1] . ' AS ' . $item[0] . '=^-^=' . $item[1];
			$tables[$item[0]] = $item[0];
		}

		foreach ($tables as $indice => $item) {
			$select[] = $item . '.id AS ' . $item . '=^-^=' . 'id';
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
			'table'      => explode(' ', $from)[0],
			'primary'    => $this->db->select("SHOW KEYS FROM {$this->tables_x_alias[$this->from[0]]} WHERE Key_name = 'PRIMARY'")[0]['Column_name']
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
		$this->rightJoin[] = $rightJoin;
		return $this;
	}

	public function innerJoin($innerJoin){
		$this->find_tables_name($innerJoin);
		$this->find_join_on($innerJoin);
		$this->innerJoin[] = $innerJoin;
		return $this;
	}

	public function fetchArray($first = null){
		$retorno =  $this->db->select($this->get_query());

		if($first == 'first'){
			return $this->convert_to_tree($retorno)[0];
		}

		return $this->convert_to_tree($retorno);;
	}

	public function get_query(){
		$this->build_query();
		return $this->query;
	}

	private function build_query(){
		if(!empty($this->select)){
			$this->query = 'SELECT ' . $this->select;
		}

		if(!empty($this->from)){
			$this->query .= " \nFROM " . $this->from[0] . ' ' . $this->from[1];
		}

		if(!empty($this->leftJoin)){
			$this->query .= " \nLEFT JOIN " . implode(" \nLEFT JOIN ", $this->leftJoin);
		}

		if(!empty($this->rightJoin)){
			$this->query .= " \nRIGHT JOIN " . implode(" \nRIGHT JOIN ", $this->rightJoin);
		}

		if(!empty($this->innerJoin)){
			$this->query .= " \nINNER JOIN " . implode(" \nINNER JOIN ", $this->innerJoin);
		}

		if(!empty($this->where)){
			$this->query .= " \nWHERE " . implode(' AND ', $this->where);
		}
	}

	private function convert_to_tree($query){
		if(empty($query)){
			return ['Nenhum resultado ou erro na query'];
		}

		$this->get_height_nodes();
		$this->order_by_node_height($this->join_on, 'level', 'desc');

		$alias = [];

		foreach ($query[0] as $indice => $item) {
			$selected_alias = explode('=^-^=', $indice)[0];
			$alias[$selected_alias] = $selected_alias;
		}

		$ordenado_por_tabela = [];

		foreach($query as $tabela) {
			$primary_from = $this->from[1] . '=^-^=' . $this->join_on[$this->from[1]]['primary'];

			foreach ($tabela as $indice => $coluna) {
				$tabela_x_coluna = explode('=^-^=', $indice);

				$primary = $tabela_x_coluna[0] . '=^-^=' . $this->join_on[$tabela_x_coluna[0]]['primary'];

				if(!empty($this->join_on[$tabela_x_coluna[0]]['from_table'])){
					$foreign = $this->join_on[$this->join_on[$tabela_x_coluna[0]]['from_table']]['table'] . '=^-^=' . $this->join_on[$this->join_on[$tabela_x_coluna[0]]['from_table']]['primary'];
				}

				$ordenado_por_tabela[$tabela_x_coluna[0]][$tabela[$primary_from] . '=^-^=' . $tabela[$primary]][$tabela_x_coluna[1]]  = $coluna;
				$ordenado_por_tabela[$tabela_x_coluna[0]][$tabela[$primary_from] . '=^-^=' . $tabela[$primary]]['join_on']            = $this->join_on[$tabela_x_coluna[0]];
				$ordenado_por_tabela[$tabela_x_coluna[0]][$tabela[$primary_from] . '=^-^=' . $tabela[$primary]]['join_on']['primary'] = $tabela[$primary];
 				$ordenado_por_tabela[$tabela_x_coluna[0]][$tabela[$primary_from] . '=^-^=' . $tabela[$primary]]['join_on']['foreign']      = isset($foreign) ? $tabela[$foreign] : null;
 				$ordenado_por_tabela[$tabela_x_coluna[0]][$tabela[$primary_from] . '=^-^=' . $tabela[$primary]]['join_on']['primary_from'] = $tabela[$primary_from];
			}
		}

		foreach($this->join_on as $level) {
			foreach ($ordenado_por_tabela[$level['table']] as $resultado){

				$index = $resultado['join_on']['primary_from'] . '=^-^=' . $resultado['join_on']['foreign'];

				$tabela_join = $resultado['join_on']['table'];
				unset($resultado['join_on']);

				$ordenado_por_tabela[$level['from_table']][$index][$tabela_join][] = $resultado;
			}

			unset($ordenado_por_tabela[$level['table']]);
		}

		$ordenado_por_tabela = $this->replace_index_with_table_name($ordenado_por_tabela);

		$retorno = [];

		foreach (array_values($ordenado_por_tabela[0]) as $resultado){
			$retorno[] = $resultado[$this->from[0]][0];
		}

		return $retorno;
	}

	private function get_height_nodes(){
		$join_on = [];
		$levels = 0;

		while(count($join_on) != count($this->join_on)) {
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

					if($join_on[$indice]['level'] > $levels){
						$levels = $join_on[$indice]['level'];
					}

					continue;
				}
			}
		}

		$this->join_on = $join_on;
	}

	private function order_by_node_height(&$array, $coluna, $direcao = 'asc') {
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

	    $rename_index = [];

	    foreach ($array as $item) {
	    	$rename_index[$item['table']] = $item;
	    }

	    $array = $rename_index;
	}

	private function try_get_select_columns($table){
		$columns = $this->get_columns_name($table);
		if (!empty($columns)) {
			$retorno = [];

			foreach ($columns as $column) {
				$retorno[] = $column['column_name'];
			}

			return $retorno;
		}
		return false;
	}

	private function get_columns_name($table){

		return $this->db->select("SELECT column_name FROM information_schema.columns WHERE table_name = '{$table}'");
	}

	private function process_select_all($table, array $selects){
		$retorno = [];

		foreach ($selects as $select) {
			$retorno[] = $table . '.' . $select . ' AS ' . $table . '=^-^=' . $select;
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
			'from_table' => $from_table,
			'table'      => $join_table,
			'primary'    => $this->db->select("SHOW KEYS FROM {$this->tables_x_alias[$join_table]} WHERE Key_name = 'PRIMARY'")[0]['Column_name']
		];
	}

	private function replace_index_with_table_name($array) {
	    if(!is_array($array)){
	    	return $array;
	    }

    	$array_values = 0;
    	$new_array = [];

	    	foreach($array as $indice => $value) {
	    		if(is_numeric($indice)){
	    			$new_array[$array_values] = $value;
	    			$array_values++;
	    		}else{
	    			$new_array[$indice] = $value;
	    		}

	    	}

	    $novo_array = array();

	    foreach ($new_array as $indice => $item) {
	    	$novo_indice = isset($this->tables_x_alias[$indice]) ? $this->tables_x_alias[$indice] : $indice;
	        $novo_array[$novo_indice] = $this->replace_index_with_table_name($item);
	    }

	    return $novo_array;
	}
}

