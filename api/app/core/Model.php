<?php

class Model {
    protected $db;

    public function __construct() {
        $this->db = $this->connect();
    }

    protected function connect() {
        $dbFile = APPROOT . 'app/config/database.php';

        try {
            if(!file_exists($dbFile)) {
                throw new Exception("File not found: $dbFile");
            }
            require_once($dbFile);
        } catch (Exception  $e) {
            $this->handleError("Error", $e->getMessage());
        }

        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
            $pdo = new PDO($dsn, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            $this->handleError("Database connection failed", $e->getMessage());
        }
    }

    protected function query($sql, $params = [], $returnLastInsertId = false) {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            if ($returnLastInsertId && stripos($sql, 'INSERT') === 0) {
                return $this->db->lastInsertId();
            }
            return $stmt;
        } catch (PDOException $e) {
            print($e->getMessage());
            $this->handleError("Query failed", $e->getMessage());
        }
    }

    protected function handleError($message, $details = null) {
        error_log($message . ($details ? ": " . $details : ""));
    }

    public function getAll($table) {
        return $this->query("SELECT * FROM {$table}")->fetchAll();
    }

    public function getById($table, $id) {
        return $this->query("SELECT * FROM {$table} WHERE id = :id", ['id' => $id])->fetch();
    }
}
