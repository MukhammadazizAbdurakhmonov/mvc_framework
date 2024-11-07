<?php 

namespace Src\Core;

use PDO;
use Src\Core\Database;
use Src\Core\Request;

/**
 * Abstract class Model 
 */
abstract class Model
{
    /**
     * All errors related to model
     * @var array
     */
    public $errors = [];
    
    /**
     * Assigned table of models
     * @var 
     */
    protected $table;

    /**
     * Initialized classes
     * @param \Src\Core\Database $database
     * @param \Src\Core\Request $request
     */
    public function __construct(protected Database $database, 
                                protected Request $request)
    {
        
    }

    /**
     * Inserts new record to assigned model table with incoming data array
     * @param array $data
     * @return bool
     */
    public function save(array $data): bool
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));

        $sql = "INSERT INTO {$this->table} ($columns)
                VALUES ($placeholders)";

        $pdo = $this->database->getConnection();

        $stmt = $pdo->prepare($sql);

        $i = 1;

        foreach ($data as $value) {

            $type = match(gettype($value)) {
                "boolean" => PDO::PARAM_BOOL,
                "integer" => PDO::PARAM_INT,
                "NULL" => PDO::PARAM_NULL,
                default => PDO::PARAM_STR
            };

            $stmt->bindValue($i++, $value, $type);

        }

        return $stmt->execute();
    }

    /**
     * Get all record
     * @return array
     */
    public function getAll(): array
    {
        $pdo = $this->database->getConnection();

        $sql = "SELECT *
                FROM {$this->table}";

        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
