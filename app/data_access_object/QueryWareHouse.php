<?php

require_once __DIR__ . '/WareHouseException.php';

class QueryWareHouse {

    public function getData() {
        $sql = "SELECT * FROM config_web";
        global $mysqli;
        $result = $mysqli->query($sql);
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            throw new WareHouseException("NOT FOUND CONFIG WAREHOUSE " . $result->num_rows, 404);
        }
    }

    public function update($data) {
        $sql = "
            UPDATE config_web 
            SET cif = ?,
            business_name = ?,
            warehouse_name = ?,
            phone = ?,
            email = ?,
            web = ?,
            residence = ?,
            location = ?,
            responsable = ?
            WHERE warehouse_code = ?
        ";
        global $mysqli;
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param(
                "sssssssssi", $data['cif'], $data['business_name'], $data['warehouse_name'], $data['phone'], $data['email'], $data['web'], $data['residence'], $data['location'], $data['responsable'], $data['warehouse_code']
        );
        if ($stmt->execute()) {
            return true;
        } else {
            throw new WareHouseException($stmt->error, $stmt->errno);
        }
    }

}
