<?php
require_once("ConnexionBD.php");

class DAO
{
    // INSERT
    public static function Insert($tableName, $data)
    {
        $keys = array_keys($data);
        $values = array_values($data);
        $fieldNames = implode(", ", $keys);
        $fieldValues = implode(", ", array_fill(0, count($values), "?"));

        $statement = ConnexionBD::getInstance()->prepare(
            "INSERT INTO $tableName ($fieldNames )
        VALUES ($fieldValues)"
        );
        $statement->execute($values);
        $statement2 = ConnexionBD::getInstance()->prepare("SELECT MAX(id) FROM $tableName");
        $statement2->execute();
        return $statement2->fetchAll(PDO::FETCH_ASSOC)[0]['MAX(id)'];
    }

    // SELECT
    public static function Select($tableName, $conditions = array())
    {
        $query = "SELECT * FROM " . $tableName;

        if (!empty($conditions)) {
            $where = array();
            foreach ($conditions as $key => $value) {
                $where[] = "$key = :$key";
            }
            $query .= " WHERE " . implode(" AND ", $where);
        }
        $statement = ConnexionBD::getInstance()->prepare($query);
        $statement->execute($conditions);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public static function Update($tableName, $data, $conditions)
    {
        $set = array();
        $values = array();
        foreach ($data as $key => $value) {
            $set[] = "$key = ?";
            $values[] = $value;
        }
        $where = array();
        foreach ($conditions as $key => $value) {
            $where[] = "$key = ?";
            $values[] = $value;
        }
        $statement = ConnexionBD::getInstance()->prepare("UPDATE " . $tableName .
            " SET " . implode(", ", $set) . " WHERE " . implode(" AND ", $where));
        $statement->execute($values);
        return $statement->rowCount();
    }

    // DELETE
    public static function Delete($tableName, $conditions)
    {
        $where = array();
        $values = array();
        foreach ($conditions as $key => $value) {
            $where[] = "$key = ?";
            $values[] = $value;
        }

        $query = "DELETE FROM " . $tableName . " WHERE " . implode(" AND ", $where);

        $stmt = ConnexionBD::getInstance()->prepare($query);
        $stmt->execute($values);

        return $stmt->rowCount();
    }
}