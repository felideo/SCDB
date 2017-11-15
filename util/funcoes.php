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

function remover_acentos($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
}

function transformar_array($variavel) {

    if (!is_array($variavel)) {
        return trim($variavel);
    }

    foreach ($variavel as $chave => $cada) {

        if (is_array($cada)) {
            $variavel[$chave] = transformar_array($cada);
        } else {

            if (substr($chave, 0, 8) == 'numero__') {
                $variavel[substr($chave, 8)] = trim(transformar_numero($cada));
                unset($variavel[$chave]);
            } else if (substr($chave, 0, 6) == 'data__') {
                $variavel[substr($chave, 6)] = trim(transformar_data($cada));
                unset($variavel[$chave]);
            } else if (substr($chave, 0, 7) == 'senha__') {
                $variavel[substr($chave, 7)] = trim(transformar_senha($cada));
                unset($variavel[$chave]);
            }
        }
    }

    return $variavel;
}

