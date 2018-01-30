<?php

function get_subjects() {
    global $db;
    $query = 'SELECT * FROM subject ORDER BY subject_id';
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

function get_subject($subject_id) {
    global $db;
    $query = 'SELECT *
              FROM subject
              WHERE subject_id = :subject_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':subject_id', $subject_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function add_subject($category_id, $code, $name, $description,
        $price, $discount_percent) {
    global $db;
    $query = 'INSERT INTO subject
                 (description)
              VALUES
                 (:description)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':description', $description);
        $statement->execute();
        $statement->closeCursor();

        // Get the last subject _id that was automatically generated
        $subject_id = $db->lastInsertId();
        return $subject_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function update_subject($subject_id, $description) {
    global $db;
    $query = 'UPDATE subject
              SET description = :description,
              WHERE subject_id = :subject_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':subject_id', $subject_id);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function delete_subject($subject_id) {
    global $db;
    $query = 'DELETE FROM subject WHERE subject_id = :subject_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':subject_id', $subject_id);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
?>