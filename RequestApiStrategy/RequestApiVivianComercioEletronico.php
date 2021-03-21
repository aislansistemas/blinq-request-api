<?php

require_once "Interface/IRequestApiStrategy.php";
require_once "DTO/RequestApiDTO.php";
require_once "RequestApiAbstract.php";
require_once "Core/EnvOperation.php";

final class RequestApiVivianComercioEletronico extends RequestApiAbstract {

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
        return $this->urlPedidosApi . $this->getApiSecretKey() . $filters;
    }

    protected function getApiSecretKey(): string {
        return EnvOperation::getEnvByKeyValue("API_KEY_VIVIAN_COMERCIO_ELETRONICO");
    }
}