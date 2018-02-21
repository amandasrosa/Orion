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

function get_results_for_report($subject_id, $testDate) {
    global $db;

    $where = "";
    if ($subject_id != "" && $testDate != "") {
        $where = "WHERE r.subject_id = ".$subject_id." AND r.testDate = '".$testDate."'";
    } else if ($subject_id != "" ) {
        $where = "WHERE r.subject_id = ".$subject_id;
    } else if ($testDate != "") {
        $where = "WHERE r.testDate = '".$testDate."'";
    }

    $query = 'SELECT u.first_name, u.last_name, s.description, r.subject_id, r.grade, r.testDate, r.status
                FROM result r
                INNER JOIN user u
                ON r.user_id = u.user_id
                INNER JOIN subject s
                ON r.subject_id = s.subject_id '
                .$where.'
            ORDER BY r.grade DESC';

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

function add_result($user_id, $subject_id, $grade, $status) {
    global $db;
    $query = 'INSERT INTO result
                 (user_id, subject_id, grade, testDate, status)
              VALUES
                 (:user_id, :subject_id, :grade, NOW(), :status)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':subject_id', $subject_id);
        $statement->bindValue(':grade', $grade);
        $statement->bindValue(':status', $status);
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

function update_result($result_id, $user_id, $subject_id, $grade, $status) {
    global $db;
    $query = 'UPDATE result
              SET user_id = :user_id,
                  subject_id = :subject_id,
                  grade = :grade,
                  testDate = NOW(),
                  status = :status
              WHERE result_id = :result_id';
    try {
        $statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':subject_id', $subject_id);
        $statement->bindValue(':grade', $grade);
        $statement->bindValue(':status', $status);
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