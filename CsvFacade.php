<?php

	require_once "./CsvGenerator.php";
	require_once "./Helpers/DefinitionRequestLojaApi.php";
	require_once "Enum/NomeLojaEnum.php";
	require_once "DTO/RequestApiDTO.php";

	if(!empty($_GET)) {
		try {

            if(empty($_GET['nome_loja']))
                throw new Exception("Informe a loja e tente novamente!");

            if(empty($_GET['data']))
                throw new Exception("Informe uma data e tente novemente!");

            $requestApiDTO = new RequestApiDTO();
            $requestApiDTO->createFromArray($_GET);

            $requestApi = DefinitionRequestLojaApi::verificarRequestApiLoja($requestApiDTO->getNomeLoja());
            $pedidos = $requestApi->getPedidosApi($requestApiDTO);

            $nomeLoja = NomeLojaEnum::getNomeLojaByEnum($requestApiDTO->getNomeLoja());
            (new CsvGenerator())->gerarCsv($pedidos, $nomeLoja);

        } catch (Exception $exp) {
            header("Location: index.php?error={$exp->getMessage()}");
        }
	}
