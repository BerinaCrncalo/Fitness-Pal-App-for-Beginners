<?php

class Config {

    public static function JWT_SECRET() {
        return "secret-key-refaberka";
    }
    public static function DB_HOST() {
        return 'localhost'; 
    }

    public static function DB_PORT() {
        return '3306'; 
    }

    public static function DB_USERNAME() {
        return 'root'; 
    }

    public static function DB_PASSWORD() {
        return 'database1'; 
    }

    public static function DB_SCHEMA() {
        return 'fitness_app'; 
    }

}
?>
