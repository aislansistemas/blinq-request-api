<?php

    require_once "./NumberOperationUtils.php";

	class CsvGenerator {

        public function gerarCsv(array $pedidos, string $nomeArquivo) {
            try {
                $nomeArquivoFormatado = $this->getNomeArquivoFormatado($nomeArquivo);
                header('Content-type: application/csv');
                header("Content-Disposition: attachment; filename=relatorio_{$nomeArquivoFormatado}.csv");
                header('Content-Transfer-Encoding: binary');
                header('Pragma: no-cache');
                $out = fopen('php://output', 'w');

                fputcsv($out, $this->getColunasCsv(), ";");
                foreach ($this->definedDataForCsv($pedidos) as $result => $dados) {
                    fputcsv($out, $dados, ";");
                }
                fclose($out);
            } catch (Exception $exp) {
                throw new Exception("Desculpe não foi possível gerar o csv no momento!");
            }
		}

		private function definedDataForCsv(array $pedidos): array {
			$dadosArquivo = [];
			foreach ($pedidos as $key => $pedido) {

		    	if(empty($pedido->pedido->itens)) {
		    		continue;
		    	}
				$itensPedido = (array)$pedido->pedido->itens;
		    	foreach ($itensPedido as $keyed => $itemPedido) {

                    $precoCustoFormatado = NumberOperationUtils::formatarMoeda((float)$itemPedido->item->precocusto);
                    $dadosArquivo[] = [
                        $pedido->pedido->numero,
                        date($pedido->pedido->data),
                        $precoCustoFormatado,
                        utf8_decode($pedido->pedido->situacao)
                    ];
                }

		    }

		    return $dadosArquivo;
		}

		private function getColunasCsv(): array {
			$colunasCsv = [
				utf8_decode("Número do pedido"), 
				"Data", 
				utf8_decode("Preço do produto"),
				utf8_decode("Situação do pedido")
			];

			return $colunasCsv;
		}

		private function getNomeArquivoFormatado(string $nomeArquivo): string {
            $nomeArquivoFormatado = str_replace(" ", "_", $nomeArquivo);
            return strtolower($nomeArquivoFormatado);
        }
	}
?>