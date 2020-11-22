<?php
/**
 * Created by PhpStorm.
 * Author: Abdeljabar Taoufikallah
 * Date: 11/21/20
 * Time: 12:48 PM
 */

namespace TheFramework\PDO;

require_once 'DbConnection.php';

class DbTable
{
    private $pdo;
    private $table;
    private $primaryKey;
    
    public function __construct(string $table, string $primaryKey)
    {
        $this->pdo = \DbConnection::getPdo();
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    private function query($sql, $params=[]) {
        $query = $this->pdo->prepare($sql);
        $query->execute($params);

        return $query;
    }

    public function findAll() {
        $result = $this->query('SELECT * FROM `' . $this->table . '`');
        return $result->fetchAll();
    }

    public function findBy($fields=[]) {

        $query = 'SELECT * FROM `' . $this->table . '` WHERE ';

        $params = [];

        foreach ($fields as $k => $v) {
            $query .= ' `' . $k . '` = :' . $k . ' AND ';
            $params[$k] = $v;
        }

        $query = rtrim($query, 'AND ');

        $result = $this->query($query, $params);
        return $result->fetchAll();
    }

    public function findOneBy($fields=[]) {

        $query = 'SELECT * FROM `' . $this->table . '` WHERE ';

        $params = [];

        foreach ($fields as $k => $v) {
            $query .= ' `' . $k . '` = :' . $k . ' AND ';
            $params[$k] = $v;
        }

        $query = rtrim($query, 'AND ') . ' LIMIT 1';

        $result = $this->query($query, $params);
        return $result->fetch();
    }

    public function findByContactAndUser($contact, $current) {
        $query = 'SELECT * FROM message WHERE (from_user_id = :contact and to_user_id = :currentUser) OR (from_user_id = :currentUser and to_user_id = :contact) ORDER BY created_at ASC';

        $params['contact'] = $contact;
        $params['currentUser'] = $current;

        $result = $this->query($query, $params);
        return $result->fetchAll();
    }

    public function findContacts($current) {
        $query = 'SELECT * FROM `user` WHERE id != :currentUser';
        $result = $this->query($query, ['currentUser' => $current]);

        return $result->fetchAll();
    }

    public function findById($value) {
        $query = 'SELECT * FROM `' . $this->table . '` WHERE ' . $this->primaryKey . '` = :value';
        $params = [
            'value' => $value
        ];

        $query = $this->query($query, $params);

        return $query->fetch();
    }

    public function total() {
        $query = $this->query($this->pdo, 'SELECT COUNT(*) FROM `' . $this->table . '`');
        $row = $query->fetch();
        return $row[0];
    }

    public function save($record) {
        if (!isset($record[$this->primaryKey])) {
            $record[$this->primaryKey] = null;
            $id = $this->insert($record);
        } else {
            $id = $this->update($record);
        }

        return $id;
    }

    public function delete($id) {
        $params = [':id' => $id];
        $this->query('DELETE FROM ' . $this->table . ' WHERE `' . $this->primaryKey . '` = :id', $params);
    }

    private function insert($fields) {
        $query = 'INSERT INTO `' . $this->table . '` (';

        foreach ($fields as $k => $v) {
            $query .= '`' . $k . '`,';
        }

        $query = rtrim($query, ',');

        $query .= ') VALUES (';

        foreach ($fields as $k => $v) {
            $query .= ':' . $k . ',';
        }

        $query = rtrim($query, ',');

        $query .= ')';

        $fields = $this->fixDates($fields);

        $this->query($query, $fields);

        return $this->pdo->lastInsertId();
    }

    private function update($fields) {
        $query = 'UPDATE  `' . $this->table . '` SET ';

        $fields = $this->fixDates($fields);

        foreach ($fields as $k => $v) {
            $query .= '`' . $k . '` = :' . $k . ',';
        }

        $query = rtrim($query, ',');

        $query .= ' WHERE `' . $this->primaryKey . '` = :primaryKey';

        $fields['primaryKey'] = $fields[$this->primaryKey];

        $this->query($query, $fields);

        return $this->pdo->lastInsertId();
    }

    private function fixDates($fields) {
        foreach ($fields as $k => $v) {
            if ($v instanceof  \DateTime) {
                $fields[$k] = $v->format('Y-m-d H:i:s');
            }
        }

        return $fields;
    }

    public function findNewByContactAndUser($other, $current)
    {
        $query = 'SELECT * FROM message WHERE read_at is null AND to_user_id = :currentUser and from_user_id = :contact ORDER BY created_at ASC';

        $params['contact'] = $other;
        $params['currentUser'] = $current;

        $result = $this->query($query, $params);
        return $result->fetchAll();
    }

}