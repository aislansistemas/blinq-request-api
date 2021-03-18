<?php

	require_once "./CsvGenerator.php";
	require_once "./Helpers/DefinitionRequestLojaApi.php";
	require_once "Enum/NomeLojaEnum.php";
	require_once "DTO/RequestApiDTO.php";

	if(!empty($_GET)) {
		try {

            $requestApiDTO = new RequestApiDTO();
            $requestApiDTO->createFromArray($_GET);

            $requestApi = DefinitionRequestLojaApi::verificarRequestApiLoja($requestApiDTO->getNomeLoja());
            $pedidos = $requestApi->getPedidosApi($requestApiDTO);

            (new CsvGenerator())->gerarCsv($pedidos, NomeLojaEnum::getNomeLojaByEnum($requestApiDTO->getNomeLoja()));

        } catch (Exception $exp) {
            header("Location: index.php?error={$exp->getMessage()}");
        }
	}
