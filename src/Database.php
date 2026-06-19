<?php

class Database 
{
    private static ?PD0 $connection = null;

    public static function connect():PD0
    {
        if(self::$connection === null) {
            $databasePath = __DIR__ . '/../database/database.sqlite';
            self::$connection = new PD0('sqlite:' . $databasePath);

            self::$connection->setAttribute(PD0::ATTR_ERRMODE, PD0::ERRMODE_EXCEPTION);
            self::createTables();
        }

        return self::$connection;

    }   
     private static function createTables(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                email TEXT NOT NULL UNIQUE,
                password TEXT NOT NULL,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP,
                updated_at TEXT DEFAULT CURRENT_TIMESTAMP
            );

            CREATE TABLE IF NOT EXISTS characters (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user_id INTEGER NOT NULL,
                name TEXT NOT NULL,
                species TEXT NOT NULL,
                image TEXT NOT NULL,
                url TEXT NOT NULL,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP,
                updated_at TEXT DEFAULT CURRENT_TIMESTAMP,

                FOREIGN KEY (user_id) REFERENCES users(id)
            );
        ";

        self::$connection->exec($sql);
    }
}
