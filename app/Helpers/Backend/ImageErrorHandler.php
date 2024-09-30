<?php

function ImageHandler($error_code)
{

    switch($error_code){
        case 1:
            return "O tamanho máximo permitido é de 2mb!";
        break;

        case 2:
            return "Extensão não permitida, envie apenas JPEG, JPG, WEBP e PNG!";
        break;

        default:
            return true;
    }
}

?>