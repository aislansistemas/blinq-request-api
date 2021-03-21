<?php

require_once "Interface/IRequestApiStrategy.php";

abstract class RequestApiAbstract implements IRequestApiStrategy {

    protected $urlPedidosApi = "https://bling.com.br/Api/v2/pedidos/json&apikey=";

    protected abstract function getFilters(RequestApiDTO $requestApiDTO): string;
    protected abstract function montarUrlPedidosRequestApi(string $filters): string;
    protected abstract function getApiSecretKey(): string;
}