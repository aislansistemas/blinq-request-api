<?php

require_once "Interface/IRequestApiStrategy.php";

class RequestApiVivianComercioEletronico implements IRequestApiStrategy {

    const API_SECRET_KEY = "61d28bff43eb1fea4cc578fd4aff7e141d109e5bde0e756a408f347b793f36deaf63b67a";
    const URL_PEDIDOS_API = "https://bling.com.br/Api/v2/pedidos/json&apikey=";

    function getPedidos(): array {
        $urlPedidos = self::URL_PEDIDOS_API . self::API_SECRET_KEY . $this->getFilters();
        $ch = curl_init($urlPedidos);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $results = (array)json_decode(curl_exec($ch));

        if(empty($results['retorno']->pedidos))
            throw new Exception("Nenhum registro encontrado para a data atual!");

        $pedidos = $results['retorno']->pedidos;

        return $pedidos;
    }

    private function getFilters(): string {
        date_default_timezone_set('America/Sao_Paulo');
        //$dataInicial = date("d/m/Y", strtotime(date("Y-m-d")."-6 month"));
        $dataAtual = (new DateTime())->format('d/m/Y');
        $filters = "&filters=dataEmissao[{$dataAtual} TO {$dataAtual}]";
        return $filters;
    }

}