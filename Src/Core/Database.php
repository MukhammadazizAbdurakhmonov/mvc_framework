<?php

namespace Src\Core;

use PDO;

/**
 * Database class to connect to database
 */
class Database
{
    /**
     * PDO 
     * @var 
     */
    private ?PDO $pdo = null;

    /**
     * Host of the database example, localhost
     * @var string
     */
    private string $host = '';
    /**
     * Name of the database example, book_store
     * @var string
     */
    private string $name = '';
    /**
     * Username for the database example, root in MySQL
     * @var string
     */
    private string $user = '';
    /**
     * Password for the database
     * @var 
     */
    private  $password = null;

    /**
     * Connection method to connect database
     * @return \PDO
     */
    public function getConnection(): PDO
    {
        if ($this->pdo === null) {

            $dsn = "mysql:host={$this->host};dbname={$this->name};charset=utf8;port=3306";

            $this->pdo = new PDO($dsn, $this->user, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }

        return $this->pdo;
    }
}
