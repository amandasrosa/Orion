<?php 

require_once('model/database.php');
require_once('model/user_db.php');
require_once('model/subject_db.php');

if (isset($_POST['signIn'])) {

	$username = $_POST['username'];
	//$password = $_POST['password'];
}

$getUser = get_user($username);
$getTypeUser = $getUser['flag_admin'];
$getSubjects = get_subjects();

include 'view/header.php'; ?>

<section>

	<p>Welcome <?php echo $getUser['first_name']."!"; ?></p>

	<?php if($getTypeUser == 0) { ?>

	<form class="form-group" action="doAssessment.php" method="post">
		<button type="submit" class="btn-basic" name="doAssessment" >Take the test</button>
		<?php foreach($getSubjects as $subject) { ?>
		<div class="form-check">
			<label class="cursor" for="sub<?php echo $subject['subject_id']; ?>">
				<input type="radio" class="form-check-input" id="sub<?php echo $subject['subject_id']; ?>" name="subjectRadio" value="<?php echo $subject['subject_id']; ?>" required>
				<?php echo $subject['description']; ?>
			</label>
		</div>
		<?php } ?>
	</form>
	<form class="form-group" action="userRegister.php" method="post">
		<button type="submit" class="btn-basic" name="editProfile" >Edit Profile</button>
	</form>
	<form class="form-group" action="index.php" method="post">
		<button type="submit" class="btn-basic" name="signOut" >Sign out</button>
	</form>

	<?php } else {?>

	<form class="form-group" action="editQnS.php" method="post">
		<button type="submit" class="btn-basic" name="editSubjects" >Edit Subjects</button>
	</form>
	<form class="form-group" action="editQnS.php" method="post">
		<button type="submit" class="btn-basic" name="editQuestions" >Edit Questions</button>
		<?php foreach($getSubjects as $subject) { ?>
		<div class="form-check">
			<label class="cursor" for="sub<?php echo $subject['subject_id']; ?>">
				<input type="radio" id="sub<?php echo $subject['subject_id']; ?>" name="subjectRadio" value="<?php echo $subject['subject_id']; ?>" required>
				<?php echo $subject['description']; ?>
			</label>
		</div>
		<?php } ?>
	</form>
	<form class="form-group" action="report.php" method="post">
		<button type="submit" class="btn-basic" name="report" >Reports</button>
	</form>
	<form class="form-group" action="index.php" method="post">
		<button type="submit" class="btn-basic" name="signOut" >Sign out</button>
	</form>

	<?php }?>


</section>

<?php include 'view/footer.php'; ?>