<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Mysqli class for the $db instance
class DB extends mysqli
{
    public function __construct($dbname = null)
    {
        try {
            parent::__construct(
                $_ENV['DB_HOST'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASS'],
                $dbname ?? $_ENV['DB_NAME']
            );
        } catch (Exception $e) {
            echo "<pre>" . print_r($e, 1) . "</pre>";
        }
    }
}
// Error msg reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
global $db;
// The database instance
$db = new DB();
// Charset
$db->set_charset("utf8mb4");


