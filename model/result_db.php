<?php

function get_results_by_user($user_id) {
    global $db;
    $query = 'SELECT * FROM result
              WHERE user_id = :user_id
              ORDER BY result_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_results_by_subject($subject_id) {
    global $db;
    $query = 'SELECT * FROM result
              WHERE subject_id = :subject_id
              ORDER BY result_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':subject_id', $subject_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_results() {
    global $db;
    $query = 'SELECT * FROM result ORDER BY result_id';
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

function get_result($result_id) {
    global $db;
    $query = 'SELECT *
              FROM result
              WHERE result_id = :result_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':result_id', $result_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function add_result($user_id, $subject_id, $grade) {
    global $db;
    $query = 'INSERT INTO result
                 (user_id, subject_id, grade, testDate)
              VALUES
                 (:user_id, :subject_id, :grade, NOW())';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':subject_id', $subject_id);
        $statement->bindValue(':grade', $grade);
        $statement->execute();
        $statement->closeCursor();

        // Get the last result _id that was automatically generated
        $result_id = $db->lastInsertId();
        return $result_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function update_result($result_id, $user_id, $subject_id, $grade, $testDate) {
    global $db;
    $query = 'UPDATE result
              SET user_id = :user_id,
                  subject_id = :subject_id,
                  grade = :grade,
                  testDate = NOW()
              WHERE result_id = :result_id';
    try {
        $statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':subject_id', $subject_id);
        $statement->bindValue(':grade', $grade);
        $statement->bindValue(':testDate', $testDate);
        $statement->bindValue(':result_id', $result_id);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function delete_result($result_id) {
    global $db;
    $query = 'DELETE FROM result WHERE result_id = :result_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':result_id', $result_id);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
?>