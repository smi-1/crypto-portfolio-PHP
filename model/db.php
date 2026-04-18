<?php
// Mysqli class for the $db instance
class DB extends mysqli
{
    // Constructor, database name as an argument
    public function __construct($dbname = 'crypto')
    {
        try {
            // Database information
            parent::__construct('localhost', 'username', 'password', $dbname);
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


