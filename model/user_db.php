<?php

function get_users() {
    global $db;
    $query = 'SELECT * FROM user ORDER BY user_id';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_user($username) {
    global $db;
    $query = 'SELECT *
              FROM user
              WHERE username = :username';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function add_user($flag_admin, $username, $password, $name,
        $email, $phone, $address) {
    global $db;
    $query = 'INSERT INTO user
                 (flag_admin, username, password, first_name, last_name,
                  email, phone, address)
              VALUES
                 (:flag_admin, :username, :password, :first_name, :last_name, :email,
                  :phone, :address)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':flag_admin', $flag_admin);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':first_name', $first_name);
        $statement->bindValue(':last_name', $last_name);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':address', $address);
        $statement->execute();
        $statement->closeCursor();

        // Get the last user _id that was automatically generated
        $user_id = $db->lastInsertId();
        return $user_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function update_user($user_id, $flag_admin, $username, $password,
                        $first_name, $last_name, $email, $phone, $address) {
    global $db;
    $query = 'UPDATE Products
              SET flag_admin = :flag_admin,
                  username = :username,
                  password = :password,
                  first_name = :first_name,
                  last_name = :last_name,
                  email = :email,
                  phone = :phone
                  address = :address
              WHERE user_id = :user_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':flag_admin', $flag_admin);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':first_name', $first_name);
        $statement->bindValue(':last_name', $last_name);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':address', $address);
        $statement->bindValue(':user_id', $user_id);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function delete_user($user_id) {
    global $db;
    $query = 'DELETE FROM user WHERE user_id = :user_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
?>