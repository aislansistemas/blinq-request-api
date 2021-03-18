<?php

require_once "./Enum/NomeLojaEnum.php";
require_once "./RequestApiStrategy/RequestApi.php";
require_once "./RequestApiStrategy/RequestApiVianxDistribuidoraFabricante.php";
require_once "./RequestApiStrategy/RequestApiVivianComercioEletronico.php";

class DefinitionRequestLojaApi {

    public static function verificarRequestApiLoja(int $valorLoja): RequestApi {

        switch($valorLoja) {
            case NomeLojaEnum::$RequestApiVianxDistribuidoraFabricante:
                return new RequestApi(new RequestApiVianxDistribuidoraFabricante());
            case NomeLojaEnum::$RequestApiVivianComercioEletronico:
                return new RequestApi(new RequestApiVivianComercioEletronico());
            default:
                throw new Exception("Ops! Informe o nome da loja e tente novamente!");
        }

    }
}