<?php

require_once "Interface/IRequestApiStrategy.php";

class RequestApi {

    private $requestApi;

    public function __construct(IRequestApiStrategy $requestApiStrategy) {
        $this->requestApi = $requestApiStrategy;
    }

    public function getPedidosApi():array {
        return $this->requestApi->getPedidos();
    }
}