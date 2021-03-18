<?php

	require_once "./CsvGenerator.php";
	require_once "./Helpers/DefinitionRequestLojaApi.php";
	require_once "Enum/NomeLojaEnum.php";

	if(!empty($_GET)) {
		try {

            $requestApi = DefinitionRequestLojaApi::verificarRequestApiLoja($_GET['nome_loja']);
            $pedidos = $requestApi->getPedidosApi();

            (new CsvGenerator())->gerarCsv($pedidos, NomeLojaEnum::getNomeLojaByEnum($_GET['nome_loja']));

        } catch (Exception $exp) {
            echo $exp->getMessage();
        }
	}
