<?php 

require_once('model/database.php');
require_once('model/user_db.php');
require_once('model/subject_db.php');

$getUser = get_user("amanda");
$getTypeUser = $getUser['flag_admin'];
$getSubjects = get_subjects();
print_r($getSubjects);

include 'view/header.php'; ?>

<section>

	<p>Welcome <?php echo $getUser['first_name']."!"; ?></p>

	<?php if($getTypeUser == 0) { ?>

	<form class="form-group" action="doAssessment.php" method="post">
		<button type="submit" class="btn btn-primary" name="doAssessment" >Take the task</button>
		<?php foreach($getSubjects as $subject) { ?>
		<div class="form-check">
			<label class="form-check-label" for="sub<?php echo $subject['subject_id']; ?>">
				<input type="radio" class="form-check-input" id="sub<?php echo $subject['subject_id']; ?>" name="subjectRadio" value="<?php echo $subject['subject_id']; ?>" required>
				<?php echo $subject['description']; ?>
			</label>
		</div>
		<?php } ?>
	</form>
	<form class="form-group" action="login.php" method="post">
		<button type="submit" class="btn btn-primary" name="editProfile" >Edit Profile</button>
	</form>
	<form class="form-group" action="index.php" method="post">
		<button type="submit" class="btn btn-primary" name="signOut" >Sign out</button>
	</form>

	<?php } else {?>

	<form class="form-group" action="editQnS.php" method="post">
		<button type="submit" class="btn btn-primary" name="editSubjects" >Edit Subjects</button>
	</form>
	<form class="form-group" action="editQnS.php" method="post">
		<button type="submit" class="btn btn-primary" name="editQuestions" >Edit Questions</button>
		<?php foreach($getSubjects as $subject) { ?>
		<div class="form-check">
			<label class="form-check-label" for="sub<?php echo $subject['subject_id']; ?>">
				<input type="radio" class="form-check-input" id="sub<?php echo $subject['subject_id']; ?>" name="subjectRadio" value="<?php echo $subject['subject_id']; ?>" required>
				<?php echo $subject['description']; ?>
			</label>
		</div>
		<?php } ?>
	</form>
	<form class="form-group" action="report.php" method="post">
		<button type="submit" class="btn btn-primary" name="report" >Reports</button>
	</form>
	<form class="form-group" action="index.php" method="post">
		<button type="submit" class="btn btn-primary" name="signOut" >Sign out</button>
	</form>

	<?php }?>


</section>

<?php include 'view/footer.php'; ?>