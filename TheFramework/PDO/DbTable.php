<?php
/**
 * Created by PhpStorm.
 * Author: Abdeljabar Taoufikallah
 * Date: 11/21/20
 * Time: 12:48 PM
 */

namespace TheFramework\PDO;

class DbTable
{
    private $pdo;
    private $table;
    private $primaryKey;
    
    public function __construct(\PDO $pdo, string $table, string $primaryKey)
    {
        $this->pdo = $pdo;
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
        try {
            if ($record[$this->primaryKey] == '') {
                $record[$this->primaryKey] = null;
            }
            $this->insert($this->table, $record);
        } catch (\PDOException $exception) {
            $this->update($this->table, $this->primaryKey, $record);
        }
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
    }

    private function update($fields) {
        $query = 'UPDATE  `' . $this->table . '` SET ';

        foreach ($fields as $k => $v) {
            $query .= '`' . $k . '` = ' . $v . ',';
        }

        $query = rtrim($query, ',');

        $query .= ' WHERE `' . $this->primaryKey . '` = :primaryKey';

        $fields['primaryKey'] = $fields['id'];

        $fields = $this->fixDates($fields);

        $this->query($query, $fields);
    }

    private function fixDates($fields) {
        foreach ($fields as $k => $v) {
            if ($v instanceof  \DateTime) {
                $fields[$k] = $v->format('Y-m-d');
            }
        }

        return $fields;
    }

}