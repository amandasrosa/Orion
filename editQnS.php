<?php 

require_once('model/database.php');
require_once('model/question_db.php');
require_once('model/subject_db.php');

include 'view/header.php'; ?>

<section>
<form class="form-editQS" action="editQnS.php" method="post">
<?php if (isset($_POST['editSubjects'])) { 

	$subjects = get_subjects();

	foreach ($subjects as $subject) { ?>
	<div>
		<input type="text" class="input-user-resgistration fontSmaller" name="<?php echo htmlspecialchars($subject['subject_id']);?>" value="<?php echo htmlspecialchars($subject['description']); ?>"/>
		<img src="images/delete-icon.png" alt="Delete" height="45" width="45" class="alignBottomImg cursor">
	</div>
	<?php }?>
	<img src="images/add-icon.png" alt="Add" height="45" width="45" class="cursor addIcon">


<?php } ?>



<?php if (isset($_POST['editQuestions'])) { 

	$subjectId = $_POST['subjectRadio'];
	$questions = get_questions_by_subject($subjectId);

	foreach ($questions as $question) { ?> 

	<div>
		<input type="text" class="input-user-resgistration fontSmaller" name="<?php echo htmlspecialchars($question['question_id']);?>" value="<?php echo htmlspecialchars($question['description']); ?>"/>
		<img src="images/delete-icon.png" alt="Delete" height="45" width="45" class="alignBottomImg cursor" >
		<input type="text" class="input-user-resgistration editOptions fontSmaller" name="<?php echo htmlspecialchars($question['question_id']);?>" value="<?php echo htmlspecialchars($question['optionA']); ?>"/>
		<input type="text" class="input-user-resgistration editOptions fontSmaller" name="<?php echo htmlspecialchars($question['question_id']);?>" value="<?php echo htmlspecialchars($question['optionB']); ?>"/>
		<input type="text" class="input-user-resgistration editOptions fontSmaller" name="<?php echo htmlspecialchars($question['question_id']);?>" value="<?php echo htmlspecialchars($question['optionC']); ?>"/>
		<input type="text" class="input-user-resgistration editOptions fontSmaller" name="<?php echo htmlspecialchars($question['question_id']);?>" value="<?php echo htmlspecialchars($question['optionD']); ?>"/>
	</div>
	<?php }?>

	<img src="images/add-icon.png" alt="Add" height="45" width="45" class="cursor addIcon">

<?php } ?>
<div class="center">
	<button type="submit" class="btn-basic" name="save" >Save</button>
</div>
</form>
</section>

<?php include 'view/footer.php'; ?>