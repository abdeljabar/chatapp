<?php
/**
 * Created by PhpStorm.
 * Author: Abdeljabar Taoufikallah
 * Date: 11/21/20
 * Time: 2:03 PM
 */

class DbConnection {
    /**
     * @return Pdo
     */
    public static function getPdo(): Pdo
    {
        try {
            $pdo = new Pdo('mysql:host=localhost;dbname=chatapp', 'root', 'password!');
        } catch (PDOException $exception) {
            die('Unable to connect to the DB Server: ' . $exception->getMessage());
        }
        return $pdo;
    }
}