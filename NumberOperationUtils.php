<?php

class NumberOperationUtils {

    public static function formatarMoeda(float $valor): string {
        return "R$" . number_format($valor, 2, ",", ".");
    }
}