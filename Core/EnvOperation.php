<?php


class EnvOperation {

    public static function getEnvByKeyValue(string $keyName) {
        $envFile = parse_ini_file(".env");
        $envValue = $envFile[$keyName];
        if(empty($envValue))
            throw new OutOfBoundsException("Chave invalída!");

        return $envValue;
    }
}