<?php

class NomeLojaEnum {

    public static $RequestApiVianxDistribuidoraFabricante = 1;
    public static $RequestApiVivianComercioEletronico = 2;

    public static function getComboEnum(): array {
        $nomeLoja = [
            [
                'nome_loja' => 'Vianx Destribuidora e Fabricante',
                'value' => self::$RequestApiVianxDistribuidoraFabricante
            ],
            [
                'nome_loja' => 'Vivian Comércio de Eletrônico',
                'value' => self::$RequestApiVivianComercioEletronico
            ]
        ];

        return $nomeLoja;
    }

    public static function getNomeLojaByEnum(int $valueEnum): string {
        $nomeLoja = "";
        foreach (self::getComboEnum() as $loja) {
            if($loja['value'] === $valueEnum) {
                $nomeLoja = $loja['nome_loja'];
            }
        }

        return $nomeLoja;
    }

}