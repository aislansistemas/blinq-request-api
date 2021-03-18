<?php

require_once "Interface/IRequestApiStrategy.php";
require_once "DTO/RequestApiDTO.php";

class RequestApi {

    private $requestApi;

    public function __construct(IRequestApiStrategy $requestApiStrategy) {
        $this->requestApi = $requestApiStrategy;
    }

    public function getPedidosApi(RequestApiDTO $requestApiDTO):array {
        return $this->requestApi->getPedidos($requestApiDTO);
    }
}