<?php

namespace Project;

use PDO;
use PDOException;
class Database
{
    private static ?PDO $db = null;
    private static string $databasePath = __DIR__ . '/../db/database.sqlite';

    private function __construct() {}

    public static function getConnection(): PDO
    {
        if(self::$db === null) {
            try {
                $dsn = 'sqlite:' . self::$databasePath;
                self::$db = new PDO($dsn);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                self::createTable();
            } catch (PDOException $e) {
                die("Database connection error: " . $e->getMessage());
            }
        }
        return  self::$db;
    }

    public static function createTable(): void
    {
        $db = self::getConnection();
        $db->exec("CREATE TABLE IF NOT EXISTS products (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            description TEXT,
            price REAL NOT NULL
        )");
    }
}