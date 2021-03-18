<?php

require_once "DTO/RequestApiDTO.php";

interface IRequestApiStrategy {
    function getPedidos(RequestApiDTO $requestApiDTO): array;
}