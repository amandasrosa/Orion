<?php 

require_once('model/database.php');
require_once('model/question_db.php');
require_once('model/subject_db.php');

include 'view/header.php'; ?>

<section>

<?php if (isset($_POST['editSubjects'])) { 

	$subjects = get_subjects();

	foreach ($subjects as $subject) { ?>

	<input type="text" class="input-user-resgistration" name="<?php echo htmlspecialchars($subject['subject_id']);?>" value="<?php echo htmlspecialchars($subject['description']); ?>"
		
	<?php }?>


<?php } ?>




<?php if (isset($_POST['editQuestions'])) { 

	$subjectId = $_POST['subjectRadio'];
	$questions = get_questions_by_subject($subjectId);

	//print_r($questions);
	foreach ($questions as $question) { ?> 


	<input type="text" class="input-user-resgistration" name="<?php echo htmlspecialchars($question['question_id']);?>" value="<?php echo htmlspecialchars($question['description']); ?>"
		
	<?php }?>




<?php } ?>

</section>

<?php include 'view/footer.php'; ?>