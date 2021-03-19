<?php

require_once "Interface/IRequestApiStrategy.php";
require_once "DTO/RequestApiDTO.php";
require_once "RequestApiAbstract.php";

final class RequestApiVivianComercioEletronico extends RequestApiAbstract {

    private const API_SECRET_KEY = "61d28bff43eb1fea4cc578fd4aff7e141d109e5bde0e756a408f347b793f36deaf63b67a";

    public function getPedidos(RequestApiDTO $requestApiDTO): array {
        $urlPedidos = $this->montarUrlPedidosRequestApi($this->getFilters($requestApiDTO));
        $ch = curl_init($urlPedidos);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $results = (array)json_decode(curl_exec($ch));

        if(empty($results['retorno']->pedidos))
            throw new Exception("Nenhum registro encontrado para a data informada!");

        $pedidos = $results['retorno']->pedidos;

        return $pedidos;
    }

    protected function getFilters(RequestApiDTO $requestApiDTO): string {
        date_default_timezone_set('America/Sao_Paulo');
        //$dataInicial = date("d/m/Y", strtotime(date("Y-m-d")."-6 month"));
        $dataAtual = (new DateTime())->format('d/m/Y');
        $dataFilter = $requestApiDTO->getData() ?? $dataAtual;
        $filters = "&filters=dataEmissao[{$dataFilter} TO {$dataAtual}]";
        return $filters;
    }

    protected function montarUrlPedidosRequestApi(string $filters): string {
        return $this->urlPedidosApi . self::API_SECRET_KEY . $filters;
    }
}