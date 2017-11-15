<?php
namespace Libs;
use \Libs\QueryBuilder\QueryBuilder;

abstract class Model {
	protected $query;

	function __construct() {
		$this->db    = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
		$this->query = new QueryBuilder($this->db);
	}

	public function get_query(){
		return $this->query;
	}

	public function create($table, $data){
		$data += [
			'ativo' => 1,
		];

		return $this->get_insert($table, $data);
	}

	public function get_insert($table, $data) {
		return $this->db->insert($table, $data);
	}

	public function update($table, $id, $data){
		$data += [
			'ativo' => 1,
		];

		return $this->db->update($table, $data, "`id` = {$id}");
	}

	public function update_relacao($table, $where, $id, $data){
		return $this->db->update($table, $data, "`{$where}` = {$id}");
	}

	public function delete($table, $id) {

		$data = [
			'ativo' => 0,
		];

		$result = $this->db->update($table, $data, "`id` = {$id}");

		return $result;
	}

	public function delete_relacao($table, $where, $id) {

		$data = [
			'ativo' => 0,
		];

		$result = $this->db->update($table, $data, "`{$where}` = {$id}");

		return $result;
	}

	public function load_full_list($table){
		$full_list = 'SELECT * FROM ' . $table;
		return $this->db->select($full_list);
	}

	public function load_active_list($table) {
		return $this->db->select('SELECT * FROM ' . $table . ' WHERE ativo = 1');
	}

	public function full_load_by_id($table, $id){
		$query = 'SELECT * FROM ' . $table
			. ' WHERE ID = ' . $id
			. ' AND ativo = 1';
		return $this->db->select($query);
	}

	public function full_load_by_column($table, $column, $id){
		$query = 'SELECT * FROM ' . $table
			. ' WHERE ' . $column . ' = ' . $id
			. ' AND ativo = 1';
		return $this->db->select($query);
	}

	public function carregar_listagem($busca, $datatable){
		$select = "SELECT " . implode(', ', $datatable['select'])
			. " FROM " . $datatable['from']
			. " WHERE ativo = 1";

		if(isset($busca['search']['value']) && !empty($busca['search']['value'])){
			foreach ($datatable['search'] as $indice => $column){
				if($indice == 0){
					$select .= " AND {$column} LIKE '%{$busca['search']['value']}%'";
				}else{
					$select .= " OR {$column} LIKE '%{$busca['search']['value']}%'";
				}
			}
		}

		if(isset($busca['order'][0])){
			$select .= " ORDER BY {$datatable['select'][$busca['order'][0]['column']]} {$busca['order'][0]['dir']}";
		}

		if(isset($busca['start']) && isset($busca['length'])){
			$select .= " LIMIT {$busca['start']}, {$busca['length']}";
		}

		return $this->db->select($select);
	}
}

