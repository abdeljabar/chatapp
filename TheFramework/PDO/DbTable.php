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
    private function query($pdo, $sql, $params=[]) {
        $query = $pdo->prepare($sql);
        $query->execute($params);

        return $query;
    }

    public function total($pdo, $table) {
        $query = $this->query($pdo, 'SELECT COUNT(*) FROM `' . $table . '`');
        $row = $query->fetch();
        return $row[0];
    }

    public function findById($pdo, $table, $primaryKey, $value) {
        $query = 'SELECT * FROM `' . $table . '` WHERE ' . $primaryKey . '` = :value';
        $params = [
            'value' => $value
        ];

        $query = $this->query($pdo, $query, $params);

        return $query->fetch();
    }

    private function insert($pdo, $table, $fields) {
        $query = 'INSERT INTO `' . $table . '` (';

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

        $this->query($pdo, $query, $fields);
    }

    private function update($pdo, $table, $primaryKey, $fields) {
        $query = 'UPDATE  `' . $table . '` SET ';

        foreach ($fields as $k => $v) {
            $query .= '`' . $k . '` = ' . $v . ',';
        }

        $query = rtrim($query, ',');

        $query .= ' WHERE `' . $primaryKey . '` = :primaryKey';

        $fields['primaryKey'] = $fields['id'];

        $fields = $this->fixDates($fields);

        $this->query($pdo, $query, $fields);
    }

    public function save($pdo, $table, $primaryKey, $record) {
        try {
            if ($record[$primaryKey] == '') {
                $record[$primaryKey] = null;
            }
            $this->insert($pdo, $table, $record);
        } catch (\PDOException $exception) {
            $this->update($pdo, $table, $primaryKey, $record);
        }
    }

    public function delete($pdo, $table, $primaryKey, $id) {
        $params = [':id' => $id];
        $this->query($pdo, 'DELETE FROM ' . $table . ' WHERE `' . $primaryKey . '` = :id', $params);
    }

    public function findAll($pdo, $table) {
        $result = $this->query($pdo, 'SELECT * FROM `' . $table . '`');
        return $result->fetchAll();
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