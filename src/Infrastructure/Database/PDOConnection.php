<?php

namespace Src\Infrastructure\Database;

use PDO;
use PDOException;
use RangeException;

final class PDOConnection
{
    private array $config = [
        "host" => "",
        "port" => "",
        "dbname" => "",
        "user" => "",
        "password"=> "",
    ];

    public function __construct(){}

    public function createConnection(): PDO
    {
        $dsn = "pgsql:host={$this->config['host']};port={$this->config['port']};dbname={$this->config['dbname']}";

        try {
            $pdo = new PDO(
                $dsn,
                $this->config['user'],
                $this->config['password'],
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );

            return $pdo;


        } catch (PDOException $e) {

            throw new RangeException("Não foi possível conectar ao banco de dados: " . $e->getMessage() );
        }
    }
}