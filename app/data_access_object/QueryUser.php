<?php

require_once __DIR__ . '/WareHouseException.php';

class QueryUser{


    /////////////////////////////////////////////
    // RETURN USER WHERE USERNAME AND PASSWORD //
    ////////////////////////////////////////////
    public function login($username, $password){

        // sql query
        $sql = "SELECT * FROM user WHERE username = ? AND password = PASSWORD(?)";
        // db connection
        global $mysqli;
        // create the statement
        $stmt = $mysqli->stmt_init();
        // prepare the query
        $stmt->prepare($sql);
        // bind values
        $stmt->bind_param("ss", $username, $password);
        // execute the query
        if($stmt->execute()){

            // if ok get the query result
            $result = $stmt->get_result();
            // check the 
            if($result->num_rows > 0){
                // fetch the data
                $data = $result->fetch_assoc();
                // create the user object and return it
                $user = new User(
                    $data['username'],
                    $data['password'],
                    $data['email'],
                    REAL_IP,
                    $data['image']
                );
                $user->setId($data['id']);
                return $user;

            }else{
                // if no rows returned throw exception
                throw new WareHouseException('Not found', 404);
            }

        }else{
            // if query failed throw exception with mysqli error
            throw new WareHouseException($stmt->error, $stmt->errno);
        }

    }
 

    /////////////////////////////////////
    // INSERT NEW USER TO THE DATABASE //
    /////////////////////////////////////
    public function register($username, $email, $password){

        // query to execute
        $sql = "
            INSERT INTO user(id, username, email, password, create_time)
            VALUES(NULL, ?, ?, PASSWORD(?), NOW())
        ";
        // connect to db
        global $mysqli;
        // start statement
        $stmt = $mysqli->stmt_init();
        // prepare the query
        $stmt->prepare($sql);
        // bind the data
        $stmt->bind_param("sss", $username, $email, $password);
        // execute the query
        if($stmt->execute()){
            // if ok return the new id
            return $stmt->insert_id;
        }else{
            // else throw an exception with the mysqli error
            throw new WareHouseException($stmt->error, $stmt->errno);
        }

    }


    ///////////////////////////
    // CHANGE THE USER IMAGE //
    ///////////////////////////
    public function changeImage(int $id, $image){

        // sql query
        $sql = "UPDATE user SET image = ? WHERE id = ?";
        // db connection
        global $mysqli;
        // create the statement
        $stmt = $mysqli->stmt_init();
        // prepare the query
        $stmt->prepare($sql);
        // bind values
        $stmt->bind_param("si", $image, $id);
        // execute the query
        if($stmt->execute()){
            return true;
        }else{
            // if query failed throw exception with mysqli error
            throw new WareHouseException($stmt->error, $stmt->errno);
        }

    }


    //////////////////////////////
    // CHANGE THE USER PASSWORD //
    //////////////////////////////
    public function changePassword(int $id, $password){

        // sql query
        $sql = "UPDATE user SET password = PASSWORD(?) WHERE id = ?";
        // db connection
        global $mysqli;
        // create the statement
        $stmt = $mysqli->stmt_init();
        // prepare the query
        $stmt->prepare($sql);
        // bind values
        $stmt->bind_param("si", $password, $id);
        // execute the query
        if($stmt->execute()){
            return true;
        }else{
            // if query failed throw exception with mysqli error
            throw new WareHouseException($stmt->error, $stmt->errno);
        }

    }


    ///////////////////////////
    // CHANGE THE USER EMAIL //
    ///////////////////////////
    public function changeEmail(int $id, $email){

        // sql query
        $sql = "UPDATE user SET email = ? WHERE id = ?";
        // db connection
        global $mysqli;
        // create the statement
        $stmt = $mysqli->stmt_init();
        // prepare the query
        $stmt->prepare($sql);
        // bind values
        $stmt->bind_param("si", $email, $id);
        // execute the query
        if($stmt->execute()){
            return true;
        }else{
            // if query failed throw exception with mysqli error
            throw new WareHouseException($stmt->error, $stmt->errno);
        }

    }

}