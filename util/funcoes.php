<?php

//Por Felideo Oficial!
function debug2($var, $legenda = false, $exit = false) {
    //Se for ajax deve ser exibido em JSON FORMAT
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

        if(is_array(carregar_UTF8($var))){
            echo json_encode(carregar_UTF8($var));
        }else{
            echo json_encode(array(carregar_UTF8($var)));
        }

    }else{

        echo "\n<pre style='position: relative; z-index: 99999;''>";
        echo "============================ DEBUG2 OFICIAL ==========================\n";



        foreach($GLOBALS as $var_name => $value) {
            if ($value === $var) {

                $variavel = "Variavel => $" . $var_name;

                $tamanho = strlen ($variavel);
                $tabs = str_repeat('&nbsp;', (70 - $tamanho) / 2);
                echo $tabs . $variavel . "\n";
            }
        }

        if ($legenda){
            $legenda = strtoupper($legenda);
            $tamanho = strlen ($legenda);
            $tabs = str_repeat('&nbsp;', (70 - $tamanho) / 2);
            echo $tabs . $legenda . "\n\n";
        }
        if (is_array($var) || is_object($var)) {
            echo htmlentities(print_r($var, true));
        } elseif (is_string($var)) {
            echo "string(" . strlen($var) . ") \"" . htmlentities($var) . "\"\n";
        } else {
            var_dump($var);
        }
        // echo "\n=============== FIM ===============\n";
        echo "\n";
        debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        echo "</pre>";
    }

    if ($exit) {
        die;
    }
}

function carregar_variavel($nome, $padrao = '') {
    if (isset($_POST[$nome])) {
        return transformar_array($_POST[$nome]);
    }

    if (isset($_GET[$nome])) {
        return transformar_array($_GET[$nome]);
    }

    if (isset($_FILES[$nome])) {
        return $_FILES[$nome];
    }

    $geral_get = explode('?', urldecode($_SERVER['REQUEST_URI']));

    if (isset($geral_get[1])) {
        $parametros_get = explode('&', $geral_get[1]);
        foreach ($parametros_get as $parametro) {
            $valor = explode('=', $parametro);

            if (count($valor) == 2) {
                if ($valor[0] == $nome) {
                    return $valor[1];
                }
            }
        }
    }

    return $padrao;
}

function transformar_array($variavel) {

    if (!is_array($variavel)) {
        return $variavel;
    }

    foreach ($variavel as $chave => $cada) {

        if (is_array($cada)) {
            $variavel[$chave] = transformar_array($cada);
        } else {

            if (substr($chave, 0, 8) == 'numero__') {
                $variavel[substr($chave, 8)] = transformar_numero($cada);
                unset($variavel[$chave]);
            } else if (substr($chave, 0, 6) == 'data__') {
                $variavel[substr($chave, 6)] = transformar_data($cada);
                unset($variavel[$chave]);
            } else if (substr($chave, 0, 7) == 'senha__') {
                $variavel[substr($chave, 7)] = transformar_senha($cada);
                unset($variavel[$chave]);
            }
        }
    }

    return $variavel;
}

function gravar_banco_dados($post = array(), $tabela) {
    $db = new Libs\Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    $db->insert($tabela, $post);
}

function modulos(){
    $path = 'views/';
    $results = scandir($path);

    foreach ($results as $indice => $result) {
        if ($result === '.' or $result === '..') continue;

        if (is_dir($path . '/' . $result)) {
            $retorno[$indice] = $result;
        }
    }

    return array_values($retorno);
}