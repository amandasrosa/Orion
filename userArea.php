<?php 
session_start();
$_SESSION['username'] = $_POST['username'];

require_once('model/database.php');
require_once('model/user_db.php');
require_once('model/subject_db.php');

if (isset($_POST['signIn'])) {

	$username = $_POST['username'];
	//$password = $_POST['password'];
} else {
    $username = filter_input(INPUT_GET, 'username');
}

$getUser = get_user($username);
$getTypeUser = $getUser['flag_admin'];
$getSubjects = get_subjects();

include 'view/header.php'; ?>

<section>

	<div class="center">
		<p>Welcome <?php echo $getUser['first_name']."!"; ?></p>
	</div>

	<?php if($getTypeUser == 0) { ?>

	<form class="form-signin" action="doAssessment.php" method="post">
		<button type="submit" class="btn-basic" name="doAssessment" >Take the test</button>
		<?php foreach($getSubjects as $subject) { ?>
		<div class="">
			<label class="cursor" for="sub<?php echo $subject['subject_id']; ?>">
				<input type="radio" id="sub<?php echo $subject['subject_id']; ?>" name="subjectRadio" value="<?php echo $subject['subject_id']; ?>" required>
				<?php echo $subject['description']; ?>
			</label>
		</div>
		<?php } ?>
	</form>
	<form class="form-signin" action="userRegister.php" method="post">
		<button type="submit" class="btn-basic" name="editProfile" >Edit Profile</button>
        <input type="hidden" name="username" value="<?php echo $username?>">
	</form>
	<form class="form-signin" action="index.php" method="post">
		<button type="submit" class="btn-basic" name="signOut" >Sign out</button>
	</form>

	<?php } else {?>

	<form class="form-signin" action="editQnS.php" method="post">
		<button type="submit" class="btn-basic" name="editSubjects" >Edit Subjects</button>
	</form>
	<form class="form-signin" action="editQnS.php" method="post">
		<button type="submit" class="btn-basic" name="editQuestions" >Edit Questions</button>
		<?php foreach($getSubjects as $subject) { ?>
		<div class="">
			<label class="cursor" for="sub<?php echo $subject['subject_id']; ?>">
				<input type="radio" id="sub<?php echo $subject['subject_id']; ?>" name="subjectRadio" value="<?php echo $subject['subject_id']; ?>" required>
				<?php echo $subject['description']; ?>
			</label>
		</div>
		<?php } ?>
	</form>
	<form class="form-signin" action="report.php" method="post">
		<button type="submit" class="btn-basic" name="report" >Reports</button>
	</form>
	<form class="form-signin" action="index.php" method="post">
		<button type="submit" class="btn-basic" name="signOut" >Sign out</button>
	</form>

	<?php }?>


</section>

<?php include 'view/footer.php'; ?>