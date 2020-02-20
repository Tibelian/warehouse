<?php

/**
 * @author TID 2ºDAW
 */

require_once __DIR__ . '/../model/Box.php';
require_once __DIR__ . '/../model/BoxOut.php';
require_once __DIR__ . '/WareHouseException.php';

class QueryBox{

    ///////////////////////////////////////////
    // RETURN THE FULL LIST OF BOXES FROM DB //
    ///////////////////////////////////////////
    public function getFullList(){

        // here i am going to save all the boxes
        $data = [];
        // sql query
        $sql = "SELECT * FROM box";
        // connect to db
        global $mysqli;
        // if query executes successfully
        if($result = $mysqli->query($sql)){

            // check if the query returned rows
            if($result->num_rows > 0){

                // fetch the data and create the box object
                while($fetched = $result->fetch_assoc()){
                    $box = new Box(
                        $fetched['code'],
                        $fetched['material'],
                        $fetched['content'],
                        $fetched['color'],
                        $fetched['height'],
                        $fetched['width'],
                        $fetched['depth']
                    );
                    $box->setId($fetched['id']);
                    $box->setDate($fetched['date']);
                    // insert the box to the array
                    $data[] = $box;
                }

            }

        }else{
            // else throw an exception with the mysqli error
            throw new WareHouseException($mysqli->error, $mysqli->errno);
        }
        return $data;

    }


    //////////////////////////////////
    // RETURN BOXES WHERE shelf ID //
    //////////////////////////////////
    public function getWhereshelfId($id){

        // array container
        $data = [];
        // cast the id to int
        $shelfId = (int) $id;
        // sql query
        $sql = "
            SELECT b.* FROM box b
            INNER JOIN association a
            ON a.box_id = b.id
            WHERE a.shelf_id = $shelfId
        ";
        // connec to database
        global $mysqli;
        
        // execute the query
        if($result = $mysqli->query($sql)){

            // check if returned rows
            if($result->num_rows > 0){

                // fetch data and create the object
                while($fetched = $result->fetch_assoc()){
                    $box = new Box(
                        $fetched['code'],
                        $fetched['material'],
                        $fetched['content'],
                        $fetched['color'],
                        $fetched['height'],
                        $fetched['width'],
                        $fetched['depth']
                    );
                    $box->setId($fetched['id']);
                    $box->setDate($fetched['date']);
                    // save the object to the array
                    $data[] = $box;
                }

            }

        }else{
            // throw an exception with the mysqli error
            throw new WareHouseException($mysqli->error, $mysqli->errno);
        }
        return $data;

    }


    //////////////////////////////
    // RETURN BOX ID WHERE CODE //
    //////////////////////////////
    public function getIdByCode($code){

        $sql = "SELECT id FROM box WHERE code = ?";
        global $mysqli;
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("s", $code);

        if($stmt->execute()){

            $result = $stmt->get_result();
            if($result->num_rows > 0){
                return $result->fetch_assoc()['id'];
            }else{
                throw new WareHouseException('Not Found', 404);
            }

        }else{
            throw new WareHouseException($stmt->error, $stmt->errno);
        }

    }


    ///////////////////////////
    // RETURN BOXES WHERE ID //
    ///////////////////////////
    public function getWhereId(int $id){

        // sql query
        $sql = "SELECT * FROM box WHERE id = $id";
        // connec to database
        global $mysqli;
        
        // execute the query
        if($result = $mysqli->query($sql)){

            // check if returned rows
            if($result->num_rows > 0){

                // fetch data and create the object
                while($fetched = $result->fetch_assoc()){
                    $box = new Box(
                        $fetched['code'],
                        $fetched['material'],
                        $fetched['content'],
                        $fetched['color'],
                        $fetched['height'],
                        $fetched['width'],
                        $fetched['depth']
                    );
                    $box->setId($fetched['id']);
                    $box->setDate($fetched['date']);
                    // save the object to the array
                    return $box;
                }

            }

        }else{
            // throw an exception with the mysqli error
            throw new WareHouseException($mysqli->error, $mysqli->errno);
        };

    }


    ///////////////////////////
    // RETURN BOXES WHERE ID //
    ///////////////////////////
public function getWhereCode($code){

        // sql query
        $sql = "SELECT * FROM box WHERE code = ?";
        // connec to database
        global $mysqli;

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("s", $code);

        if($stmt->execute()){
            $result = $stmt->get_result();
            // check if returned rows
            if($result->num_rows > 0){

                // fetch data and create the object
                while($fetched = $result->fetch_assoc()){
                    $box = new Box(
                        $fetched['code'],
                        $fetched['material'],
                        $fetched['content'],
                        $fetched['color'],
                        $fetched['height'],
                        $fetched['width'],
                        $fetched['depth']
                    );
                    $box->setId($fetched['id']);
                    $box->setDate($fetched['date']);
                    // save the object to the array
                    return $box;
                }

            }else{
                throw new WareHouseException('Box not found', 404);
            }
        }else{
            throw new WareHouseException($stmt->error, $stmt->errno);
        }
    


    }


    /////////////////////////////////////
    // RETURN ASSOCIATION WHERE BOX ID //
    /////////////////////////////////////
    public function getAssociationWhereBoxId($id){

        // cast the id to int
        $boxId = (int) $id;
        // sql query
        $sql = "SELECT * FROM association WHERE box_id = $boxId";
        // connec to database
        global $mysqli;
        
        // execute the query
        if($result = $mysqli->query($sql)){

            // check if returned rows
            if($result->num_rows == 1){
                // fetch data and create the object
                return $result->fetch_object();
            }else{
                // throw an exception
                throw new WareHouseException('The box id ' . $id . ' has no association. Rows found:' . $result->num_rows, 404);
            }

        }else{
            // throw an exception with the mysqli error
            throw new WareHouseException($mysqli->error, $mysqli->errno);
        };

    }


    ///////////////////////////////
    // RETURN THE COUNT OF BOXES //
    ///////////////////////////////
    public function getCount(){

        // sql query
        $sql = "SELECT COUNT(id) as num FROM box";
        // connect to db
        global $mysqli;
        // execute the query
        if($result = $mysqli->query($sql)){
            // check if the query returned the row
            if($result->num_rows > 0){
                $data = $result->fetch_assoc();
                return (int) $data['num'];
            }else{
                return 0;
            }
        }else{
            // throw an exception if the query failed with mysqli error
            throw new WareHouseException($mysqli->error, $mysqli->errno);
        }

    }


    //////////////////////////////
    // INSERT NEW ROW TO THE DB //
    //////////////////////////////
    public function insert(Box $box, $check = true){


        // comprueba si existe una caja con ese mismo código en el backup
        $found = false;
        if($check){
            $outList = self::getFullListOut();
            foreach($outList as $out){
                if($out->getCode() == $box->getCode()){
                    $found = true;
                    break;
                }
            }
        }

        if(!$found){
            // sql query
            $sql = "
                INSERT INTO box(id, code, material, content, color, height, width, depth, date)
                VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, NOW());
            ";
            // connect to db
            global $mysqli;
            // prepare the query to prevent sql injection
            $stmt = $mysqli->prepare($sql);
    
            // save the variables to bind them
            $code = $box->getCode();
            $material = $box->getMaterial();
            $content = $box->getContent();
            $color = $box->getColor();
            $height = $box->getHeight();
            $width = $box->getWidth();
            $depth = $box->getDepth();
    
            // bind the values
            $stmt->bind_param("ssssddd", $code, $material, $content, $color, $height, $width, $depth);
            
            // if the statement executed successfully
            if($stmt->execute()){
                // return the id of the inserted box
                return (int) $stmt->insert_id;
            }else{
                // throw an exception with the mysqli error
                throw new WareHouseException($stmt->error, $stmt->errno);
            }
    
        }else{
            throw new WareHouseException('Already exists code', 20202);
        }

    }


    ////////////////////
    // UPDATE THE BOX //
    ////////////////////
    public function update(Box $box){

        // sql query
        $sql = "
            UPDATE box
            SET code = ?, material = ?,
                content = ?, color = ?,
                height = ?, width = ?,
                depth = ?, date = ?
            WHERE id = ?
        ";
        // connect to db
        global $mysqli;
        // create a statement to prevent sql injection
        $stmt = $mysqli->stmt_init();
        // prepare the query
        $stmt->prepare($sql);

        // save the variables to bind them
        $code = $box->getCode();
        $material = $box->getMaterial();
        $content = $box->getContent();
        $color = $box->getColor();
        $height = $box->getHeight();
        $width = $box->getWidth();
        $depth = $box->getDepth();
        $date = $box->getDate();
        $id = $box->getId();
        // bind the values
        $stmt->bind_param("ssssdddsi", $code, $material, $content, $color, $height, $width, $depth, $date, $id);
        
        // if the statement executed successfully
        if($stmt->execute()){
            // return a boolean
            return true;
        }else{
            // throw an exception with the stmt error
            throw new WareHouseException($stmt->error, $stmt->errno);
        }

    }


    //////////////////////////////////////////////////////
    // CREATE AN ASSOCIATION BETWEEN A shelf AND A BOX //
    //////////////////////////////////////////////////////
    public function associate(int $boxId, int $shelfId, int $rack){

        // sql query
        $sql = "
            INSERT INTO association(id, shelf_id, box_id, rack_pos)
            VALUES(NULL, ?, ?, ?);
        ";
        // conect to db
        global $mysqli;
        // statement prepare query
        $stmt = $mysqli->prepare($sql);
        // bind values
        $stmt->bind_param("iii", $shelfId, $boxId, $rack);

        // check if the statement executed successfully 
        if($stmt->execute()){
            // return the id
            return (int) $stmt->insert_id;
        }else{
            // exception with mysqli error
            throw new WareHouseException($stmt->error, $stmt->errno);
        }

    }


    ////////////////////////////////
    // UPDATE THE BOX ASSOCIATION //
    ////////////////////////////////
    public function updateAssociation(int $boxId, int $shelfId, int $rack){

        // sql query
        $sql = "
            UPDATE association
            SET shelf_id = ?, rack_pos = ?
            WHERE box_id = ?
        ";
        // connect to db
        global $mysqli;
        // create a statement to prevent sql injection
        $stmt = $mysqli->stmt_init();
        // prepare the query
        $stmt->prepare($sql);

        // save the variables to bind them
        $box = $boxId;
        $shelf = $shelfId;
        $num = $rack;
        // bind the values
        $stmt->bind_param("iii", $shelf, $num, $box);
        
        // if the statement executed successfully
        if($stmt->execute()){
            // return a boolean
            return true;
        }else{
            // throw an exception with the stmt error
            throw new WareHouseException($stmt->error, $stmt->errno);
        }

    }


    ////////////////////
    // DELETE THE BOX //
    ////////////////////
    public function delete(int $id){

        // sql query
        $sql = "DELETE FROM box WHERE id = ?";
        // connect to db
        global $mysqli;
        // create a statement to prevent sql injection
        $stmt = $mysqli->stmt_init();
        // prepare the query
        $stmt->prepare($sql);
        // bind the values
        $stmt->bind_param("i", $id);
        
        // if the statement executed successfully
        if($stmt->execute()){
            // return a boolean
            return true;
        }else{
            // throw an exception with the stmt error
            throw new WareHouseException($stmt->error, $stmt->errno);
        }

    }


    ////////////////////////////////
    // DELETE THE BOX ASSOCIATION //
    ////////////////////////////////
    public function deleteAssociation(int $id){

        // sql query
        $sql = "DELETE FROM association WHERE box_id = ?";
        // connect to db
        global $mysqli;
        // create a statement to prevent sql injection
        $stmt = $mysqli->stmt_init();
        // prepare the query
        $stmt->prepare($sql);
        // bind the values
        $stmt->bind_param("i", $id);
        
        // if the statement executed successfully
        if($stmt->execute()){
            // return a boolean
            return true;
        }else{
            // throw an exception with the stmt error
            throw new WareHouseException($stmt->error, $stmt->errno);
        }

    }















    ///////////////////////////////////////
    ///////////////////////////////////////
    //// DELETED BOXES -- BACKUP TABLE ////
    ///////////////////////////////////////
    ///////////////////////////////////////

    ///////////////////////////////////////////
    // RETURN THE FULL LIST OF DELETED BOXES //
    ///////////////////////////////////////////
    public function getFullListOut(){

        // here i am going to save all the boxes
        $data = [];
        // sql query
        $sql = "
            SELECT b.*, s.code AS shelf
            FROM box_backup b
            LEFT JOIN shelf s
            ON s.id = b.shelf_id
            LEFT JOIN corridor c
            ON c.id = s.corridor_id
        ";
        // connect to db
        global $mysqli;
        // if query executes successfully
        if($result = $mysqli->query($sql)){

            // check if the query returned rows
            if($result->num_rows > 0){

                // fetch the data and create the box object
                while($fetched = $result->fetch_assoc()){
                    $box = new BoxOut(
                        $fetched['code'],
                        $fetched['material'],
                        $fetched['content'],
                        $fetched['color'],
                        $fetched['height'],
                        $fetched['width'],
                        $fetched['depth'],
                        $fetched['date'],
                        $fetched['shelf'],
                        $fetched['rack_pos'],
                        $fetched['rack_pos'],
                        $fetched['date_out']
                    );
                    $box->setId($fetched['id']);
                    $box->setShelfId($fetched['shelf_id']);
                    // insert the box to the array
                    $data[] = $box;
                }

            }

        }else{
            // else throw an exception with the mysqli error
            throw new WareHouseException($mysqli->error, $mysqli->errno);
        }
        return $data;

    }


    ///////////////////////////
    // RETURN BOXES WHERE ID //
    ///////////////////////////
    public function getWhereCodeOut($code){

        // sql query
        $sql = "
            SELECT b.*, s.code as shelf, c.letter
            FROM box_backup b
            LEFT JOIN shelf s
            ON s.id = b.shelf_id
            LEFT JOIN corridor c
            ON c.id = s.corridor_id
            WHERE b.code = ?
        ";
        // connec to database
        global $mysqli;

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("s", $code);

        if($stmt->execute()){
            $result = $stmt->get_result();
            // check if returned rows
            if($result->num_rows > 0){

                // fetch data and create the object
                while($fetched = $result->fetch_assoc()){
                    $box = new BoxOut(
                        $fetched['code'],
                        $fetched['material'],
                        $fetched['content'],
                        $fetched['color'],
                        $fetched['height'],
                        $fetched['width'],
                        $fetched['depth'],
                        $fetched['date'],
                        $fetched['shelf'],
                        $fetched['rack_pos'],
                        $fetched['letter'],
                        $fetched['date_out']
                    );
                    $box->setId($fetched['id']);
                    $box->setShelfId($fetched['shelf_id']);
                    // save the object to the array
                    return $box;
                }

            }
        }else{
            throw new WareHouseException($stmt->error, $stmt->errno);
        }
    
    }


    
    ///////////////////////////////////////////
    // RETURN A DELTED BOX TO THE MAIN TABLE //
    ///////////////////////////////////////////
    public function refund(BoxOut $box){

        global $mysqli;
        $deleteTrigger = "DROP TRIGGER `box_backup_refund`";
        $createTrigger = "
            CREATE TRIGGER `box_backup_refund`
            AFTER INSERT ON `box`
            FOR EACH ROW 
            BEGIN
            
                IF (NEW.code = '" . $box->getCode() . "') THEN

                    -- crea la ocupación
                    INSERT INTO association(id, shelf_id, box_id, rack_pos)
                    VALUES(NULL, " . $box->getShelfId() . ", NEW.id, " . $box->getRackPos() . ");
                
                    -- elimina el backup
                    DELETE FROM box_backup WHERE id = " . $box->getId() . ";
                    
                END IF;

            END;
        ";

        // intenta eliminar el trigger en caso de existir
        @$mysqli->query($deleteTrigger);

        // crea el trigger
        if($mysqli->query($createTrigger)){

            self::insert(new Box(
                $box->getCode(),
                $box->getMaterial(),
                $box->getContent(),
                $box->getColor(),
                $box->getHeight(),
                $box->getWidth(),
                $box->getDepth()
            ), false);

        }else{
            throw new WareHouseException($mysqli->error, $mysqli->errno);
        }

    }


    ////////////////////////////////////
    // RETURN THE COUNT OF SOLD BOXES //
    ///////////////////////////////////
    public function getCountOut(){

        // sql query
        $sql = "SELECT COUNT(id) as num FROM box_backup";
        // connect to db
        global $mysqli;
        // execute the query
        if($result = $mysqli->query($sql)){
            // check if the query returned the row
            if($result->num_rows > 0){
                $data = $result->fetch_assoc();
                return (int) $data['num'];
            }else{
                return 0;
            }
        }else{
            // throw an exception if the query failed with mysqli error
            throw new WareHouseException($mysqli->error, $mysqli->errno);
        }

    }





}
