<?php

require_once __DIR__ . '/../model/Shelf.php';
require_once __DIR__ . '/WareHouseException.php';

class QueryShelf {

    public function getFullList() {

        $data = [];
        $sql = "SELECT * FROM shelf";
        global $mysqli;

        if ($result = $mysqli->query($sql)) {

            if ($result->num_rows > 0) {

                while ($fetched = $result->fetch_assoc()) {
                    $shelf = new Shelf(
                            $fetched['code'], $fetched['material'], $fetched['total_rack'], $fetched['corridor_id'], $fetched['corridor_pos']
                    );
                    $shelf->setId($fetched['id']);
                    $shelf->setDate($fetched['date']);
                    $data[] = $shelf;
                }
            }
        } else {
            throw new WareHouseException($mysqli->error, $mysqli->errno);
        }
        return $data;
    }

    public function getFullListBackup() {

        $data = [];
        $sql = "SELECT * FROM shelf_backup";
        global $mysqli;

        if ($result = $mysqli->query($sql)) {

            if ($result->num_rows > 0) {

                while ($fetched = $result->fetch_assoc()) {
                    $shelf = new ShelfBackup(
                            $fetched['code'], $fetched['material'], $fetched['total_rack'], $fetched['corridor_id'], $fetched['corridor_pos'], $fetched['date'], $fetched['reason_delete'], $fetched['date_delete']
                    );
                    $shelf->setId($fetched['id']);
                    $shelf->setDate($fetched['date']);
                    $data[] = $shelf;
                }
            }
        } else {
            throw new WareHouseException($mysqli->error, $mysqli->errno);
        }
        return $data;
    }

    ////////////////////////////
    // RETURN shelf WHERE ID //
    ////////////////////////////
    public function getWhereId(int $id) {

        // sql query
        $sql = "
            SELECT s.*, c.letter 
            FROM shelf s
            LEFT JOIN corridor c
            ON c.id = s.corridor_id
            WHERE s.id = $id
        ";
        // connect to the database
        global $mysqli;

        // execute the query
        if ($result = $mysqli->query($sql)) {

            // check if returned rows
            if ($result->num_rows > 0) {

                // fetch data and create the object
                while ($fetched = $result->fetch_assoc()) {
                    $shelf = new Shelf(
                            $fetched['code'], $fetched['material'], $fetched['total_rack'], $fetched['letter'], $fetched['corridor_pos']
                    );
                    $shelf->setId($fetched['id']);
                    $shelf->setDate($fetched['date']);
                    $shelf->setCorridorId($fetched['corridor_id']);
                    // return the object
                    return $shelf;
                }
            }
        } else {
            // throw an exception with the mysqli error
            throw new WareHouseException($mysqli->error, $mysqli->errno);
        };
    }

    public function getInventory() {

        // list
        $data = [];
        // query
        $sql = "
            SELECT s.id AS shelf_id, s.code AS shelf_code, s.material AS shelf_material,
                   s.total_rack, c.letter as corridor, s.corridor_pos, s.date AS shelf_date, 
                   b.id AS box_id, b.code AS box_code, b.material AS box_material,
                   b.content, b.color, b.height, b.width, b.depth, b.date AS box_date, a.rack_pos
            FROM shelf s
            LEFT JOIN association a
            ON a.shelf_id = s.id
            LEFT JOIN box b
            ON b.id = a.box_id
            LEFT JOIN corridor c
            ON c.id = s.corridor_id
            ORDER BY s.code, b.code
        ";
        // connect to db
        global $mysqli;
        // execute the query
        if ($result = $mysqli->query($sql)) {

            if ($result->num_rows > 0) {

                $shelfList = [];
                $boxList = [];
                while ($fetched = $result->fetch_assoc()) {

                    // save the shelf 1 time
                    if (!in_array($fetched['shelf_id'], $shelfList)) {
                        $shelf = new Shelf(
                                $fetched['shelf_code'], $fetched['shelf_material'], $fetched['total_rack'], $fetched['corridor'], $fetched['corridor_pos']
                        );
                        $shelf->setId($fetched['shelf_id']);
                        $shelf->setDate($fetched['shelf_date']);
                        $data[] = $shelf;
                        $shelfList[] = $fetched['shelf_id'];
                    }

                    // save the box 1 time
                    if ($fetched['box_id'] != NULL && !in_array($fetched['box_id'], $boxList)) {
                        $box = new Box(
                                $fetched['box_code'], $fetched['box_material'], $fetched['content'], $fetched['color'], $fetched['height'], $fetched['width'], $fetched['depth']
                        );
                        $box->setId($fetched['box_id']);
                        $box->setDate($fetched['box_date']);
                        $box->setRack($fetched['rack_pos']);
                        $data[] = $box;
                        $boxList[] = $fetched['box_id'];
                    }
                }
            }
        } else {
            throw new WareHouseException($mysqli->error, $mysqli->errno);
        }
        return $data;
    }

    //
    //
    //
    public function insert(Shelf $shelf, $checkBackup = false) {

        
        if($checkBackup){
            $data = self::loadBackupWhereCode($shelf->getCode());
            if($data instanceof ShelfBackup){
                throw new WareHouseException("Already exists into backup", 2222);
            }
        }
        
        $sql = "
            INSERT INTO shelf(id, code, material, total_rack, corridor_id, corridor_pos, date)
            VALUES(NULL, ?, ?, ?, ?, ?, NOW());
        ";
        global $mysqli;
        $stmt = $mysqli->prepare($sql);

        $code = $shelf->getCode();
        $material = $shelf->getMaterial();
        $numRack = $shelf->getNumRack();
        $corridor = $shelf->getCorridor();
        $position = $shelf->getPosition();
        $stmt->bind_param("ssisi", $code, $material, $numRack, $corridor, $position);

        if ($stmt->execute()) {
            return (int) $stmt->insert_id;
        } else {
            throw new WareHouseException($stmt->error, $stmt->errno);
        }
    }

    ///////////////////////
    // UPDATE THE shelf //
    ///////////////////////
    public function update(Shelf $shelf) {

        // sql query
        $sql = "
            UPDATE shelf
            SET code = ?, material = ?,
                total_rack = ?, corridor_id = ?,
                corridor_pos = ?, date = ?
            WHERE id = ?
        ";
        // connect to db
        global $mysqli;
        // create a statement to prevent sql injection
        $stmt = $mysqli->stmt_init();
        // prepare the query
        $stmt->prepare($sql);

        // save the variables to bind them
        $code = $shelf->getCode();
        $material = $shelf->getMaterial();
        $numRack = $shelf->getNumRack();
        $corridor = $shelf->getCorridor();
        $position = $shelf->getPosition();
        $date = $shelf->getDate();
        $id = $shelf->getId();
        // bind the values
        $stmt->bind_param("ssiiisi", $code, $material, $numRack, $corridor, $position, $date, $id);

        // if the statement executed successfully
        if ($stmt->execute()) {
            // return a boolean
            return true;
        } else {
            // throw an exception with the stmt error
            throw new WareHouseException($stmt->error, $stmt->errno);
        }
    }

    ///////////////////////
    // DELETE THE shelf //
    ///////////////////////
    public function delete(int $id) {

        // sql query
        $sql = "DELETE FROM shelf WHERE id = ?";
        // connect to db
        global $mysqli;
        // create a statement to prevent sql injection
        $stmt = $mysqli->stmt_init();
        // prepare the query
        $stmt->prepare($sql);
        // bind the values
        $stmt->bind_param("i", $id);

        // if the statement executed successfully
        if ($stmt->execute()) {
            // return a boolean
            return true;
        } else {
            // throw an exception with the stmt error
            throw new WareHouseException($stmt->error, $stmt->errno);
        }
    }

    ///////////////////
    // SAVE A BACKUP //
    ///////////////////
    public function saveBackup($shelfId, $_code, $_reason) {

        global $mysqli;
        
        // try to delte the trigger if exists
        // error control @ used to prevent an exception
        $deleteTrigger = "DROP TRIGGER `shelf_before_delete`";
        @$mysqli->query($deleteTrigger);

        // prevent sql injection
        $code = $mysqli->real_escape_string($_code);
        $reason = $mysqli->real_escape_string($_reason);
        $createTrigger = "
            CREATE TRIGGER `shelf_before_delete`
            BEFORE DELETE ON `shelf`
            FOR EACH ROW 
            BEGIN
                
                -- if condition to add the reason only to the last backup
                IF (old.code = '" . $code . "') THEN

                    INSERT INTO shelf_backup(
                        id, corridor_id, corridor_pos, 
                        code, material, total_rack,
                        date, reason_delete, date_delete
                    )
                    VALUES(
                        NULL, old.corridor_id, old.corridor_pos,
                        old.code, old.material, old.total_rack,
                        old.date, '" . $reason . "', NOW()
                    );
                    
                END IF;

            END;
        ";

        // create the trigger
        if ($mysqli->query($createTrigger)) {
            self::delete($shelfId);
        } else {
            // throw an exception to prevent 
            // the controller to delete the shelf
            throw new WareHouseException($mysqli->error, $mysqli->errno);
        }
    }
    
    
    public function loadBackupWhereCode($code){
        $sql = "SELECT * FROM shelf_backup WHERE code = ?";
        global $mysqli;
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("s", $code);
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                $data = $result->fetch_assoc();
                $shelf = new ShelfBackup(
                    $data['code'], 
                    $data['material'], 
                    $data['total_rack'], 
                    $data['corridor_id'], 
                    $data['corridor_pos'], 
                    $data['reason_delete'], 
                    $data['date_delete']
                );
                $shelf->setId($data['id']);
                return $shelf;
            }
        }else{
            throw new WareHouseException($stmt->error, $stmt->errno);
        }
    }
    

    //
    //
    //
    public function getCorridorPos() {

        $sql = "SELECT SUM(total_pos) as num FROM corridor";
        global $mysqli;
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return (int) $data['num'];
        } else {
            throw new WareHouseException($stmt->error, $stmt->errno);
        }
    }

    //
    //
    //
    public function getCorridors() {

        $sql = "SELECT letter FROM corridor";
        $data = array();
        global $mysqli;
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while ($new = $result->fetch_assoc()['letter']) {
                $data[] = $new;
            }
            return $data;
        } else {
            throw new WareHouseException($stmt->error, $stmt->errno);
        }
    }

    //
    //
    //
    public function getCount() {

        $sql = "SELECT COUNT(id) as num FROM shelf";
        global $mysqli;
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return (int) $data['num'];
        } else {
            throw new WareHouseException($stmt->error, $stmt->errno);
        }
    }

    public function getCountTotalRack() {

        $sql = "SELECT SUM(total_rack) as num FROM shelf";
        global $mysqli;
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return (int) $data['num'];
        } else {
            throw new WareHouseException($stmt->error, $stmt->errno);
        }
    }

    public function getCountBusyRack() {

        $sql = "SELECT COUNT(id) as num FROM association";
        global $mysqli;
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return (int) $data['num'];
        } else {
            throw new WareHouseException($stmt->error, $stmt->errno);
        }
    }

    public function getCountFreeRack() {
        return (int) (self::getCountTotalRack() - self::getCountBusyRack());
    }

    public function obtainBusyRacks(int $id) {

        $data = [];
        $sql = "SELECT rack_pos FROM association WHERE shelf_id = $id";
        global $mysqli;
        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows > 0) {
                while ($fetched = $result->fetch_assoc()) {
                    $data[] = $fetched['rack_pos'];
                }
            }
        } else {
            throw new WareHouseException($mysqli->error, $mysqli->errno);
        }
        return $data;
    }

    public function obtainTotalRacks(int $id) {

        $sql = "SELECT total_rack FROM shelf WHERE id = $id";
        global $mysqli;
        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows > 0) {
                $fetched = $result->fetch_assoc();
                return $fetched['total_rack'];
            }
        } else {
            throw new WareHouseException($mysqli->error, $mysqli->errno);
        }
    }

    public function obtainFreeRacks(int $id) {

        $free = [];
        $total = self::obtainTotalRacks($id);
        $busy = self::obtainBusyRacks($id);
        $pos = 1;
        while ($pos <= $total) {
            if (!in_array($pos, $busy)) {
                $free[] = $pos;
            }
            $pos++;
        }
        return $free;
    }

    public function obtainTotalCorridorPositions(int $id) {

        $sql = "SELECT total_pos FROM corridor WHERE id = $id";
        global $mysqli;
        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows > 0) {
                $fetched = $result->fetch_assoc();
                return $fetched['total_pos'];
            }
        } else {
            throw new WareHouseException($mysqli->error, $mysqli->errno);
        }
    }

    // corridor busy positions
    public function obtainBusyPositions(int $id) {

        $data = [];
        $sql = "SELECT corridor_pos FROM shelf WHERE corridor_id = $id";
        global $mysqli;
        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows > 0) {
                while ($fetched = $result->fetch_assoc()) {
                    $data[] = $fetched['corridor_pos'];
                }
            }
        } else {
            throw new WareHouseException($mysqli->error, $mysqli->errno);
        }
        return $data;
    }

    public function obtainCorridorPosition(int $id) {

        $free = [];
        $total = self::obtainTotalCorridorPositions($id);
        $busy = self::obtainBusyPositions($id);
        $pos = 1;
        while ($pos <= $total) {
            if (!in_array($pos, $busy)) {
                $free[] = $pos;
            }
            $pos++;
        }
        return $free;
    }

    public function getAllCorridors() {

        $data = [];
        $sql = "SELECT * FROM corridor";
        global $mysqli;
        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows > 0) {
                while ($fetched = $result->fetch_assoc()) {
                    $data[] = $fetched;
                }
            }
        } else {
            throw new WareHouseException($mysqli->error, $mysqli->errno);
        }
        return $data;
    }

    public function getCodeById(int $id) {

        $sql = "SELECT code FROM shelf WHERE id = $id";
        global $mysqli;
        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows == 1) {
                $data = $result->fetch_assoc();
                return $data['code'];
            } else {
                throw new WareHouseException('Not found', 404);
            }
        } else {
            throw new WareHouseException($mysqli->error, $mysqli->errno);
        }
    }

    public function obtainCorridorLetter(int $shelfId) {

        $sql = "
            SELECT c.letter
            FROM shelf s
            INNER JOIN corridor c
            ON c.id = s.corridor_id
            WHERE s.id = $shelfId
        ";
        global $mysqli;
        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows > 0) {
                return $result->fetch_assoc()['letter'];
            } else {
                return 'NOT FOUND';
            }
        } else {
            throw new WareHouseException($mysqli->error, $mysqli->errno);
        }
    }

}
