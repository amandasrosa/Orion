<?php
function get_questions_by_subject($subject_id) {
    global $db;
    $query = 'SELECT * FROM question
              WHERE subject_id = :subject_id 
              AND active = 1
              ORDER BY question_id';
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

function get_questions() {
    global $db;
    $query = 'SELECT * FROM question ORDER BY question_id';
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

function get_question($question_id) {
    global $db;
    $query = 'SELECT *
              FROM question
              WHERE question_id = :question_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':question_id', $question_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function add_question($subject_id, $description, $optionA, $optionB,
        $optionC, $optionD, $answer) {
    global $db;
    $query = 'INSERT INTO question
                 (subject_id, description, optionA, optionB,
                  optionC, optionD, answer)
              VALUES
                 (:subject_id, :description, :optionA, :optionB, :optionC,
                  :optionD, :answer)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':subject_id', $subject_id);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':optionA', $optionA);
        $statement->bindValue(':optionB', $optionB);
        $statement->bindValue(':optionC', $optionC);
        $statement->bindValue(':optionD', $optionD);
        $statement->bindValue(':answer', $answer);
        $statement->execute();
        $statement->closeCursor();

        // Get the last question _id that was automatically generated
        $question_id = $db->lastInsertId();
        return $question_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function update_question($question_id, $subject_id, $description,
                        $optionA, $optionB, $optionC, $optionD, $answer) {
    global $db;
    $query = 'UPDATE question
              SET subject_id = :subject_id,
                  description = :description,
                  optionA = :optionA,
                  optionB = :optionB,
                  optionC = :optionC,
                  optionD = :optionD,
                  answer = :answer
              WHERE question_id = :question_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':subject_id', $subject_id);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':optionA', $optionA);
        $statement->bindValue(':optionB', $optionB);
        $statement->bindValue(':optionC', $optionC);
        $statement->bindValue(':optionD', $optionD);
        $statement->bindValue(':answer', $answer);
        $statement->bindValue(':question_id', $question_id);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function delete_question($question_id) {
    global $db;
    $query = 'UPDATE question
              SET active = 0
              WHERE question_id = :question_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':question_id', $question_id);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

/*function delete_question($question_id) {
    global $db;
    $query = 'DELETE FROM question WHERE question_id = :question_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':question_id', $question_id);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}*/
?>