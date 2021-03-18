<?php
    require_once "Enum/NomeLojaEnum.php";
    date_default_timezone_set('America/Sao_Paulo');
    $dataAtual = DateTime::createFromFormat('d/m/Y', date('d/m/Y'));
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
        label {
            font-weight: 600;
        }
	</style>
</head>
<body> 
	<div class="container">
        <?php if(isset($_GET['error'])) { ?>
            <div class="alert alert-danger mt-5 text-center" style="font-weight: 600" role="alert">
                <?= $_GET['error'] ?>
            </div>
        <?php } ?>

        <div class="d-flex justify-content-center bg-light p-5 mt-5" style="border-radius: 12px; box-shadow: 2px 5px 10px #808080">
            <h3 class="text-center">Pressione o botão para gerar o Csv com os dados da api</h3>
        </div>

		<div class="d-flex justify-content-center bg-light p-5 mt-5" style="border-radius: 12px; box-shadow: 2px 5px 10px #808080">
            <form action="CsvFacade.php" method="GET">
                <div class="row">
                    <div class="col-md-12 mb-5">
                        <h5 class="text-center">Informe os filtros</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Selecione a loja para gerar o CSV:</label>
                            <select class="form-control form-control-lg" name="nome_loja" required>
                                <?php foreach (NomeLojaEnum::getComboEnum() as $nomeLoja) { ?>
                                    <option value="<?= $nomeLoja['value'] ?>"><?= $nomeLoja['nome_loja'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Informe a data:</label>
                            <input type="date" class="form-control form-control-lg" name="data" value="<?= $dataAtual->format('Y-m-d') ?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="hidden" name="consultar" value="consultar">
                            <input class="btn btn-success btn-lg" type="submit" value="Gerar Csv">
                        </div>
                    </div>
                </div>
            </form>
		</div>

        <div class="d-flex justify-content-center bg-light p-2 mt-5 mb-5" style="border-radius: 12px; box-shadow: 2px 5px 10px #808080">
            <div class="col-md-12">
                <h5 class="text-center text-secondary">
                    <small><i>Obs a api do blinq tem limit de 100 registros por consulta!</i></small>
                </h5>
            </div>
        </div>

	</div>
</body>
</html>