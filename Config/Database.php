<?php

namespace Config;

use PDO;

/**
 * This class is used to interact with the database
 */
class Database
{
    private static $database = null;

    private function __construct() {
    }

    /**
     * This method instantiate a new PDO object and return it
     *
     * @return PDO|null
     */
    public static function getDatabase() {
        if(is_null(self::$database)) {
            self::$database = new PDO("mysql:host=localhost;dbname=test", 'root', '');
        }
        return self::$database;
    }
}
