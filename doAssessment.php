<?php 
session_start();
require_once('model/database.php');
require_once('model/question_db.php');
require_once('model/result_db.php');

//print_r($_SESSION);

$subjectId = filter_input(INPUT_POST, "subjectId");

$_SESSION['subjectId'] = $subjectId;
$userId = $_SESSION['userId'];

if (!isset($subjectId)) { $subjectId = "1"; }

$lastInsertedId = add_result($userId, $subjectId, 0, 'DOING');
$_SESSION['resultId'] = $lastInsertedId;

$questions = get_questions_by_subject($subjectId);

$selectedQuestions = array();

do {
    $i = mt_rand(0, count($questions) - 1);
    if (!in_array($questions[$i], $selectedQuestions)) {
        $selectedQuestions[] = $questions[$i];
    }
} while (count($selectedQuestions) < 10);

//echo "<pre>";
// print_r($selectedQuestions);
//echo "</pre>";

include 'view/header.php'; ?>

<section>

    <form class="form-questions" action="assessmentResult.php" method="post">
        <ol><?php foreach ($selectedQuestions as $item) { ?>
            <li class="list-group-question"><span><?php echo htmlspecialchars($item["description"]); ?></span></li>
            <ol  class="list-group-answer" type="a">
                <li>
                    <input type="radio" name="<?php echo $item["question_id"]; ?>" value="a" id="<?php echo $item["question_id"]; ?>a" required>
                    <span><label class="cursor" for="<?php echo $item["question_id"]; ?>a"><?php echo htmlspecialchars($item["optionA"]); ?></label></span>
                </li>
                <li>
                    <input type="radio" name="<?php echo $item["question_id"]; ?>" value="b" id="<?php echo $item["question_id"]; ?>b">
                    <span><label class="cursor" for="<?php echo $item["question_id"]; ?>b"><?php echo htmlspecialchars($item["optionB"]); ?></label></span>
                </li>
                <li>
                    <input type="radio" name="<?php echo $item["question_id"]; ?>" value="c" id="<?php echo $item["question_id"]; ?>c">
                    <span><label class="cursor" for="<?php echo $item["question_id"]; ?>c"><?php echo htmlspecialchars($item["optionC"]); ?></label></span>
                </li>
                <li>
                    <input type="radio" name="<?php echo $item["question_id"]; ?>" value="d" id="<?php echo $item["question_id"]; ?>d">
                    <span><label class="cursor" for="<?php echo $item["question_id"]; ?>d"><?php echo htmlspecialchars($item["optionD"]); ?></label></span>
                </li>
            </ol>
        <?php } ?></ol>
        <div class="center">
            <button type="submit" class="btn-basic" name="">Submit Answers</button>
        </div>
    </form>
    <form class="form-questions center" action="userArea.php" method="post">
        <button type="submit" class="btn-basic" name="abort">Abort Test</button>
    </form>
</section>

<?php include 'view/footer.php'; ?>