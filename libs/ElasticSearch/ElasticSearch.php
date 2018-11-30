<?php
namespace  Libs\ElasticSearch;
use Elasticsearch\ClientBuilder;
use Curl\Curl;


class ElasticSearch{
	private $client;

	function __construct() {
		$this->start();
	}

	private function start(){
		$hosts = [
		    '127.0.0.1:9200',         // IP + Port
		    '127.0.0.1',              // Just IP
		    'swdb.localhost:9201', // Domain + Port
		    'swdb.localhost',     // Just Domain
		    'http://localhost',        // SSL to localhost
		    'http://127.0.0.1:9200'  // SSL to IP + Port
		];
		$clientBuilder = ClientBuilder::create();   // Instantiate a new ClientBuilder


		$clientBuilder->setHosts($hosts);           // Set the hosts
		$client = $clientBuilder->build();          // Build the client object

		$this->client = $client;
	}

	public function get_client(){
		return $this->client;
	}

	public function criar_intex(){
		$params = [
		    'index' => 'swdb',
		    'body' => [
		        'settings' => [
		            'number_of_shards'   => 3,
		            'number_of_replicas' => 2
		        ],
		        'mappings' => [
		            'trabalho' => [
		                '_source' => [
		                    'enabled' => true
		                ],
		                'properties' => [
		                    'titulo' => [
								'type' => 'text'
							],
							'ano' => [
								'type' => 'integer'
							],
							'resumo' => [
								'type' => 'text',
							],
							'idioma' => [
								'type' => 'integer'
							],
							'curso' => [
								'type' => 'integer'
							],
							'campus' => [
								'type' => 'integer'
							],
							'status' => [
								'type' => 'byte'
							],
							'ativo' => [
								'type' => 'boolean'
							],
							'autor' => [
								'type' => 'text'
							],
							'orientador' => [
								'type' => 'text'
							],
							'palavra_chave' => [
								'type' => 'text'
							],
		                ]
		            ]
		        ]
		    ]
		];

		// Create the index with mappings and settings now
		$response = $this->client->indices()->create($params);
		debug2($response);
		exit;

	}

	public function busca_textual($termo){
		try{
			$query = [
				'index' => 'swdb',
				'type'  => 'trabalho',
				'body'  => [
					'query' => [
						"bool" => [
							"must" => [
								'match' => [
									'attachment.content'  => $termo,
								]
							]
						]
					],
					'stored_fields' => []
				]
			];

			return $this->client->search($query);
		} catch(\Exception $e) {
            $this->error = [
                'exception_msg' => $e->getMessage(),
                'code'          => $e->getCode(),
                'localizador'   => "Class => " . __CLASS__ . " - Function => " . __FUNCTION__ . "() - Line => " . __LINE__,
                'line'          => $e->getLine(),
                'file'          => $e->getFile(),
                'backtrace'     => $e->getTraceAsString(),
            ];

            debug2($this->error);
            exit;

            throw new \Exception(json_encode($this->error));
        }
	}

	private function carregar_autor($termo){
		$autor = $this->model->query
		 	->select('autor.nome')
		 	->from('pessoa autor')
		 	->whereIn('autor.id IN (' . $termo . ')')
		 	->fetchArray();

		foreach($autor as $indice => $autor){
			$tmp[] = $autor['nome'];
		}

		return implode(', ', $tmp);
	}

	private function carregar_orientador($termo){
		$orientador = $this->model->query
		 	->select('orientador.nome')
		 	->from('pessoa orientador')
		 	->whereIn('orientador.id IN (' . $termo . ')')
		 	->fetchArray();

		foreach($orientador as $indice => $orientador){
			$tmp[] = $orientador['nome'];
		}

		return implode(', ', $tmp);
	}

	private function carregar_palavra_chave($termo){
		$palavras_chave = $this->model->query
		 	->select('palavra_chave.palavra_chave')
		 	->from('palavra_chave palavra_chave')
		 	->whereIn('palavra_chave.id IN (' . $termo . ')')
		 	->fetchArray();

		 foreach($palavras_chave as $indice => $palavra){
			$tmp[] = $palavra['palavra_chave'];
		}

		return implode(', ', $tmp);
	}








	public function buscar_avancada($termos){
		$this->model = new \Framework\GenericModel();

		foreach($termos['busca_avancada'] as $indice_01 => $termo) {
			switch ($termo['atributo_pesquisa']) {
				case 'autor':
					$termo['valor_pesquisa'] = $this->carregar_autor($termo['valor_pesquisa']);
					break;

				case 'orientador':
					$termo['valor_pesquisa'] = $this->carregar_orientador($termo['valor_pesquisa']);
					break;

				case 'palavra_chave':
					$termo['valor_pesquisa'] = $this->carregar_palavra_chave($termo['valor_pesquisa']);
					break;
			}


			$tmp[$termo['atributo_pesquisa']][] = $termo;
		}

		$termos['busca_avancada'] = $tmp;
		unset($tmp);

		$must     = [];
		$must_not = [];
		$should   = [];
		$filter   = [];

		$tmp = [];

		foreach($termos['busca_avancada'] as $indice_01 => $termo){

			if(is_array($termo)){
				foreach($termo as $indice_02 => $item){
					$tmp[] = $item;
				}
			}else{
				$tmp[] = $termo;
			}
		}

		$termos['busca_avancada'] = array_values($tmp);

		// debug2($termos['busca_avancada']);
		// exit;

		foreach($termos['busca_avancada'] as $indice => $termo) {
			if(!isset($termo['operador_pesquisa']) || $termo['operador_pesquisa'] == 'and' || $termo['comparativo_pesquisa'] == 'diferente'){
				if($termo['comparativo_pesquisa'] == 'igual'){
					// $must[] = [
					$should[] = [

						$termo['atributo_pesquisa'],
						$termo['valor_pesquisa']
					];
				}

				if($termo['comparativo_pesquisa'] == 'diferente'){
					$must_not[] = [
						$termo['atributo_pesquisa'],
						$termo['valor_pesquisa']
					];
				}
			}

			if(isset($termo['operador_pesquisa']) && $termo['operador_pesquisa'] == 'or'){
				$should[] = [
					$termo['atributo_pesquisa'],
					$termo['valor_pesquisa']
				];
			}
		}

		// debug2($must);
		// debug2($must_not);
		// debug2($should);
		// debug2($filter);
		// exit;

		// must
		// All of these clauses must match. The equivalent of AND.
		// must_not
		// All of these clauses must not match. The equivalent of NOT.
		// should
		// At least one of these clauses must match. The equivalent of OR.
		// filter
		// Clauses that must match, but are run in non-scoring, filtering mode.


		try{
			$query = [
				'index' => 'swdb',
				'type'  => 'trabalho',
				'body'  => [
					'query' => [
						"bool" => [
						]
					],
					'stored_fields' => []
				]
			];

// {
//   "query": {
//     "bool": {
//       "must":     { "match": { "ano": "2017" }},
//       "must_not": { "match": { "ano": "2006"  }},
//       "should": [
//                   { "match": { "ano": "2016" }},
//                   { "match": { "ano": "2018"   }}
//       ]
//     }
//   }
// }




			if(!empty($must)){
				foreach($must as $indice => $item){
					$query['body']['query']['bool']['must'][]['match'] = [
						$item[0] => $item[1]
					];
				}
			}
			if(!empty($must_not)){
				foreach($must_not as $indice => $item){
					$query['body']['query']['bool']['must_not'][]['match'] = [
						$item[0] => $item[1]
					];
				}
			}
			if(!empty($should)){
				foreach($should as $indice => $item){
					$query['body']['query']['bool']['should'][]['match'] = [
						$item[0] => $item[1]
					];
				}
			}
			// if(!empty($filter)){
			// 	foreach($filter as $indice => $item){
			// 		$query['body']['query']['bool']['filter'][] = [
			// 			'match' => [
			// 				$item[0],
			// 				$item[1]
			// 			],
			// 		];
			// 	}
			// }

			// debug2(json_encode($query));
			// debug2($query);
			// debug2($this->client->search($query));

			// exit;

			return $this->client->search($query);
		} catch(\Exception $e) {
            $this->error = [
                'exception_msg' => json_decode($e->getMessage()),
                'exception'     => $e->getMessage(),
                'code'          => $e->getCode(),
                'localizador'   => "Class => " . __CLASS__ . " - Function => " . __FUNCTION__ . "() - Line => " . __LINE__,
                'line'          => $e->getLine(),
                'file'          => $e->getFile(),
                'backtrace'     => $e->getTraceAsString(),
            ];

            debug2($this->error);
            exit;

            throw new \Exception(json_encode($this->error));
        }
	}

	public function indexar($parametros){
		$this->verificar_preexistencia($parametros['id']);
		return $this->client->update($parametros);
	}

	public function indexar_documento($url_documento, $id_trabalho){
		$this->verificar_preexistencia($id_trabalho);

        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');
		$documento = [
			'arquivo' => base64_encode(file_get_contents($url_documento))
		];

        return $curl->put('127.0.0.1:9200/swdb/trabalho/' . $id_trabalho . '?pipeline=attachment', $documento);
	}

	public function verificar_preexistencia($id_trabalho){
		try{
			$parametros = [
	    		'index' => 'swdb',
	    		'type'  => 'trabalho',
	    		'id'    => $id_trabalho
			];

			$retorno = $this->client->get($parametros);
		} catch(\Exception $e) {
            $this->error = [
                'exception_msg' => $e->getMessage(),
                'code'          => $e->getCode(),
                'localizador'   => "Class => " . __CLASS__ . " - Function => " . __FUNCTION__ . "() - Line => " . __LINE__,
                'line'          => $e->getLine(),
                'file'          => $e->getFile(),
                'backtrace'     => $e->getTraceAsString(),
            ];

        	$exception_msg = json_decode($this->error['exception_msg'], true);

        	if(empty($exception_msg['found'])){
        		$parametros['body']['doc']['ativo'] = true;
				$this->client->index($parametros);
        	}
        }
	}
}