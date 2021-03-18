<?php
    require_once "Enum/NomeLojaEnum.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<style type="text/css">
		body {
			background: #dedede;
		}
	</style>
</head>
<body> 
	<div class="container">
        <div class="d-flex justify-content-center bg-light p-5 mt-5" style="border-radius: 12px; box-shadow: 2px 5px 10px #808080">
            <h3 class="text-center">Pressione o botão para gerar o Csv com os dados da api</h3>
        </div>

		<div class="d-flex justify-content-center bg-light p-5 mt-5" style="border-radius: 12px; box-shadow: 2px 5px 10px #808080">
			<form action="CsvFacade.php" method="GET">
                <div class="form-group">
                    <label style="font-weight: 600">Selecione a loja para gerar o CSV:</label>
                    <select class="form-control form-control-lg" name="nome_loja" required>
                        <?php foreach (NomeLojaEnum::getComboEnum() as $nomeLoja) { ?>
                            <option value="<?= $nomeLoja['value'] ?>"><?= $nomeLoja['nome_loja'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
				    <input type="hidden" name="consultar" value="consultar">
				    <input class="btn btn-success btn-lg" type="submit" value="Gerar Csv">
                </div>
			</form>
		</div>

	</div>
</body>
</html>