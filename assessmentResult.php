<?php 
session_start();
require_once('model/database.php');
require_once('model/question_db.php');
require_once('model/subject_db.php');
require_once('model/result_db.php');

include 'view/header.php'; 
$subjectId = $_SESSION['subjectId'];
$subjectName = get_subject($subjectId);
$questions = get_questions_by_subject($subjectId);

$count = 0;
foreach ($questions as $question) {
    foreach ($_POST as $key => $value) {
        if ($key == $question['question_id']) {
            if ($value == $question['answer']) {
                $count++;
            }
        }
    }

}

if ($count > 7 ) {
    $result = "Score ".$count."/10. You have successfully passed the test. You are now certified in ".$subjectName.".";
} else {
    $result = "Score ".$count."/10. Unfortunately you did not pass the test. Please try again later!";
}
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";?>

<section>
    <form class="center" action="userArea.php" method="post">
        <br><br><h2><?php echo $result; ?></h2><br><br><br><br>
        <button type="submit" class="btn-basic" name="menu">Back to Menu</button>
    </form>
</section>

<?php include 'view/footer.php'; ?>