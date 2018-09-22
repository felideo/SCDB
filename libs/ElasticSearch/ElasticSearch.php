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

	public function pesquisar_conteudo_documentos($termo){
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

// 			{
//   "query": {
//     "bool": {
//     	"must": [
//       	{"match": { "attachment.content": "depressão Fédida arangaricu tirimirruaaro"}}
//     	]
//     }
//   }
// }

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


		// $params['index'] = ElasticSearch::INDEX;
		// 		$params['type'] = ElasticSearch::TYPE_PRODUTO_CADASTRO;
		// 		$params['body'] = array(
		// 			'query' => array(
		// 				'filtered' => array(
		// 					'query' => array(
		// 						'match_all' => array(),
		// 					),
		// 					'filter' => array(
		// 						'bool' => array(
		// 							'must' => array(
		// 								array('term' => array('ativo' => 1)),
		// 								array('term' => array('oculto' => 0)),
		// 								array('term' => array('id_instancia' => $instancia)),
		// 							),
		// 						),
		// 					),
		// 				),
		// 			),
		// 		);
		// 		$params['from'] = $offset;
		// 		$params['size'] = $limit;
		// 		return $params;

	}

	public function indexar($parametros){
		return $this->client->index($parametros);
	}

	public function indexar_documento($url_documento, $id_trabalho){
        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');
		$documento = [
			'arquivo' => base64_encode(file_get_contents($url_documento))
		];

        debug2($curl->put('127.0.0.1:9200/swdb/trabalho/' . $id_trabalho . '?pipeline=attachment', $documento));


        debug2(get_class_methods($curl));
        exit;



        $solicitacao = [
            'email' => $email,
            'site'  => "https://www.gazetaonline.com.br/recuperarsenha?action=reset"
        ];

        $curl->post($this->end_point['esqueci_senha'], $solicitacao);

		debug2(get_class_methods($this->client));
		exit;




		$comando = "curl -XPUT '127.0.0.1:9200/swdb/trabalho/44?pipeline=attachment&pretty' -H 'Content-Type: application/json' -d '" . $documento;
		debug2(shell_exec($comando));
		debug2($comando);
		exit;



// 		exec()


	}




}