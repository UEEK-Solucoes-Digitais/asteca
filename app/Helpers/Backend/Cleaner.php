<?php

function friendlyUrl($var)
{
    try {

        // Retira tudo que não for letra e número 
        $url = preg_replace('/[^\p{L}\p{N}\s]/', '', $var);

        // Retira acentos
        $url = strtolower(preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $var));

        $url = strtolower(preg_replace("[^a-zA-Z0-9-]", "-", strtr(utf8_decode(trim($url)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));

        // Adiciona hifen nos espaços
        $url = preg_replace('/[ -]+/', '-', $url);

        $url = str_replace(".", "", $url);
        $url = str_replace("ç", "c", $url);
        $url = str_replace("Ç", "C", $url);

        $url = preg_replace('/[^\w]+/', '-', $url);

        // Retorna
        return $url;
    } catch (Exception $e) {
        error_log($e->getMessage(), 0);
    }
}
