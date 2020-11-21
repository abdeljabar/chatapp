<?php
/**
 * Created by PhpStorm.
 * Author: Abdeljabar Taoufikallah
 * Date: 11/21/20
 * Time: 2:03 PM
 */

try {
    $pdo = new Pdo('mysql:host=localhost;dbname=chatapp', 'root', 'password!');
} catch (PDOException $exception) {
    die('Unable to connect to the DB Server: ' . $exception->getMessage());
}