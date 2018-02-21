<?php
/**
 * Created by PhpStorm.
 * User: dgois
 * Date: 2018-02-17
 * Time: 2:49 PM
 */

require_once('model/database.php');
require_once('model/question_db.php');
require_once('model/subject_db.php');

$action = '';
function isUpdate($actionToCompare) {
    return strcasecmp("update", $actionToCompare) == 0;
}

// Prepare form to Edit question
if (isset($_GET["questionId"])) {
    $question = get_question($_GET["questionId"]);
    $subject = get_subject($question["subject_id"]);
    $action = "update";


// Prepare form to new question
} else if (isset($_GET["subjectId"])) {
    $subject = get_subject($_GET["subjectId"]);
    $action = "insert";
    $question = array();
    $question['question_id'] = null;
    $question['description'] = '';
    $question['optionA'] = '';
    $question['optionB'] = '';
    $question['optionC'] = '';
    $question['optionD'] = '';
    $question['answer'] = '';

} else if (isset($_POST["cancelEditQuestion"])) {
    header("Location: http://localhost/orion/editQnS.php?questSubjectId=$_POST[questionSubjectId]");

} else if (isset($_POST["saveQuestion"])) {
    $updatedLines = upsert_question(
            $_POST["questionId"],
            $_POST["questionSubjectId"],
            $_POST["inputDescription"],
            $_POST["inputOptionA"],
            $_POST["inputOptionB"],
            $_POST["inputOptionC"],
            $_POST["inputOptionD"],
            $_POST["selectAnswer"]);
    if ($updatedLines > 0) {
        header("Location: http://localhost/orion/editQnS.php?questSubjectId=$_POST[questionSubjectId]");
    }
}

include 'view/header.php'; ?>

    <section class="section-form">
        <form action="upsertQuestion.php" method="post" class="form-upsert-question center-me validate">
            <input type="hidden" name="questionId" value="<?php echo $question['question_id'] ?>">
            <?php if(isUpdate($action)) { ?>
                <input type="hidden" name="questionSubjectId" value="<?php echo $question['subject_id'] ?>">
                <h1 class="center-text">Edit Question:</h1>
            <?php } else { ?>
                <input type="hidden" name="questionSubjectId" value="<?php echo $subject['subject_id'] ?>">
                <h1 class="center-text">New Question:</h1>

            <?php } ?>
            <label for="inputDescription" class="label-user-resgistration label-right">Subject:</label>
            <label for="inputDescription" class="label-user-resgistration-left"><?php echo $subject['description']; ?></label>

            <label for="inputDescription" class="label-user-resgistration label-right">Description:</label>
            <textarea rows="8" name="inputDescription" class="input-form input-60" placeholder="Question Description" maxlength="500" required><?php echo $question['description']; ?></textarea>
            <div class="error-message hidden" id="error-for-inputDescription">Please inform a valid question description.</div>

            <label for="inputOptionA" class="label-user-resgistration label-right">Option A:</label>
            <input type="text" name="inputOptionA" class="input-form input-60" placeholder="Option A"
                   required value="<?php echo $question['optionA'] ?>" maxlength="200">
            <div class="error-message hidden" id="error-for-inputOptionA">Please inform a valid option.</div>

            <label for="inputOptionB" class="label-user-resgistration label-right">Option B:</label>
            <input type="text" name="inputOptionB" class="input-form input-60" placeholder="Option B"
                   required value="<?php echo $question['optionB'] ?>" maxlength="200">
            <div class="error-message hidden" id="error-for-inputOptionB">Please inform a valid option.</div>

            <label for="inputOptionC" class="label-user-resgistration label-right">Option C:</label>
            <input type="text" name="inputOptionC" class="input-form input-60" placeholder="Option C"
                   required value="<?php echo $question['optionC'] ?>" maxlength="200">
            <div class="error-message hidden" id="error-for-inputOptionC">Please inform a valid option.</div>

            <label for="inputOptionD" class="label-user-resgistration label-right">Option D:</label>
            <input type="text" name="inputOptionD" class="input-form input-60" placeholder="Option D"
                   required value="<?php echo $question['optionD'] ?>" maxlength="200">
            <div class="error-message hidden" id="error-for-inputOptionD">Please inform a valid option.</div>

            <label for="selectAnswer" class="label-user-resgistration label-right">Correct Answer:</label>
            <select name="selectAnswer" class="input-form input-60" required>
                <option value=""></option>
                <option value="a" <?php if( $question['answer'] == 'a' ) { echo 'selected="selected"';} ?>>A</option>
                <option value="b" <?php if( $question['answer'] == 'b' ) { echo 'selected="selected"';} ?>>B</option>
                <option value="c" <?php if( $question['answer'] == 'c' ) { echo 'selected="selected"';} ?>>C</option>
                <option value="d" <?php if( $question['answer'] == 'd' ) { echo 'selected="selected"';} ?>>D</option>
            </select>
            <div class="error-message hidden" id="error-for-selectAnswer">Please inform a valid option.</div>

            <section>
                <?php if (!empty($errorMessage)) {
                    showErrorMessage($errorMessage);
                }
                ?>
            </section>

            <section class="user-registration-buttons">
                <input class="btn-basic btn-user-registration" type="submit" value="Cancel" name="cancelEditQuestion" id="cancel" onclick="event.target.form.classList.remove('validate')">
                <input class="btn-basic btn-user-registration" type="submit" value="Save" name="saveQuestion">
            </section>
        </form>
    </section>
    <script src="js/formValidation.js"></script>
<?php include 'view/footer.php'; ?>