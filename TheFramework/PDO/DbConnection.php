<?php
/**
 * Created by PhpStorm.
 * Author: Abdeljabar Taoufikallah
 * Date: 11/21/20
 * Time: 2:03 PM
 */

include_once __DIR__ . '/../../config/db_config.php';

class DbConnection {
    /**
     * @return Pdo
     */
    public static function getPdo(): Pdo
    {
        try {

            $pdo = new Pdo('mysql:host='.SERVER.';dbname='.DBNAME, DBUSER, DBPASSWORD);
        } catch (PDOException $exception) {
            echo 'Unable to connect to the DB Server. 
<form action="/install" method="post">

<label>
DB Server: 
<input type="text" name="server"/>
</label><br/>

<label>
DB name: 
<input type="text" name="dbname"/>
</label><br/>

<label>
DB user: 
<input type="text" name="user"/>
</label><br/>

<label>
DB password: 
<input type="text" name="password"/>
</label><br/>

<button type="submit">Click here to install</button>
</form>';
            //$exception->getMessage();
            exit;
        }
        return $pdo;
    }
}