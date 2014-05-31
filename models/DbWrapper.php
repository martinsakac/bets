<?php

class DbWrapper {

    private static $connection;

    private static $settings = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false,
    );

    public static function connect($host, $user, $password, $database) {
        if (!isset(self::$connection)) {
            self::$connection = @new PDO(
                "mysql:host=$host;dbname=$database",
                $user,
                $password,
                self::$settings
            );
        }
    }

    public static function queryFetchFirst($query, $params = array()) {
        $result = self::$connection->prepare($query);
        $result->execute($params);
        return $result->fetch();
    }

    public static function queryFetchAll($query, $params = array()) {
        $result = self::$connection->prepare($query);
        $result->execute($params);
        return $result->fetchAll();
    }

    public static function queryFirstAttribute($query, $params = array()) {
        $result = self::queryFetchFirst($query, $params);
        return $result[0];
    }

    // vrati pocet ovplyvnenych riadkov
    public static function query($query, $params = array()) {
        $result = self::$connection->prepare($query);
        $result->execute($params);
        return $result->rowCount();
    }

}