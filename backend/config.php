<?php
// Set the reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));

class Config
{
    public static function DB_NAME()
    {
        return 'devdrift2'; //restaurant_db
    }
    public static function DB_PORT()
    {
        return  3307;
    }
    public static function DB_USER()
    {
        return 'root';
    }
    public static function DB_PASSWORD()
    {
        return '';
    }
    public static function DB_HOST()
    {
        return 'localhost';
    }

    public static function JWT_SECRET() {
        return 'your_key_string';
    }

}
?>