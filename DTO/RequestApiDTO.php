<?php

class RequestApiDTO {

    private $data;
    private $nomeLoja;

    public function getData(string $format = 'd/m/Y') {
        return $this->data->format($format);
    }

    public function setData($data){
        $this->data = DateTime::createFromFormat('Y-m-d', $data);
    }

    public function getNomeLoja() {
        return $this->nomeLoja;
    }

    public function setNomeLoja(int $nomeLoja) {
        $this->nomeLoja = $nomeLoja;
    }

    public function createFromArray(array $dados) {
        $this->setData($dados['data']);
        $this->setNomeLoja($dados['nome_loja']);
    }

}