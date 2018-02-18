<?php
require_once('model/database.php');
require_once('model/question_db.php');
/**
 * Created by PhpStorm.
 * User: dgois
 * Date: 2018-02-18
 * Time: 6:14 PM
 */
if (isset($_POST['questionIdToDelete'])) {
    $question = get_question($_POST['questionIdToDelete']);
    delete_question($question['question_id']);
    $subjectId = $question['subject_id'];
    header("Location: http://localhost/orion/editQnS.php?questSubjectId=$subjectId");
}