<?php
/**
 * Created by PhpStorm.
 * Author: Abdeljabar Taoufikallah
 * Date: 11/22/20
 * Time: 5:38 AM
 */

namespace App\Controller;


class InstallerController
{
    public function install() {
        $servername = $_POST['server'];
        $username = $_POST['user'];
        $password = $_POST['password'];
        $dbname = $_POST['dbname'];

        try {
            $conn = new \PDO("mysql:host=$servername", $username, $password);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $dbSql = 'create database ' . $dbname . ';';
            $dbSql .= 'use ' . $dbname . ';';
            $dbSql .= file_get_contents(__DIR__ . '/../../sql/db.sql');

            $conn->exec($dbSql);

            header('location: /login');
            exit;

        } catch(\PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;

    }
}