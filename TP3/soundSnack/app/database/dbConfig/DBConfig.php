<?php

//Clase encargada de retornar los parametros necesarios para establecer la conexión a la base de datos indicada.
final class DBConfig
{
    private const PROTOCOL = "mysql:host=";
    private const HOST = "localhost;";
    private const PORT = "port=3306;";
    private const DATABASE = "dbname=soundSnack";
    private const USER = "root";
    private const PASSWORD = "";

    private function __construct() {}

    public static function getDSN(): string
    {
        return self::PROTOCOL . self::HOST . self::PORT . self::DATABASE;
    }

    public static function getDSNWithoutDB(): string
    {
        return self::PROTOCOL . self::HOST . self::PORT;
    }

    public static function getUser(): string
    {
        return self::USER;
    }

    public static function getPassword(): string
    {
        return self::PASSWORD;
    }

    public static function getDatabase(): string
    {
        return self::DATABASE;
    }
}
