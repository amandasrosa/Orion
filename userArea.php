<?php 
session_start();

require_once('model/database.php');
require_once('model/user_db.php');
require_once('model/subject_db.php');
require_once('model/result_db.php');

if (isset($_POST['signIn'])) {
	$username = $_POST['username'];
	//$password = $_POST['password'];
} else if (isset($_GET['username'])) {
    $username = $_GET['username'];
}

if (isset($_POST['abort'])) {
	$resultId = $_SESSION['resultId'];
	$userId = $_SESSION['userId'];
	$subjectId = $_SESSION['subjectId'];
	$rowCountUpdate = update_result($resultId, $userId, $subjectId, 0, 'ABORTED');
}

$getSubjects = get_subjects();
$getTypeUser = "";
$getUser = get_user($username);
$getTypeUser = $getUser['flag_admin'];

if (!isset($_SESSION['username'])) {
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['name'] = $getUser['first_name'];
	$_SESSION['userId'] = $getUser['user_id'];
	$_SESSION['flag_admin'] = $getUser['flag_admin'];
}

include 'view/header.php'; ?>

<section>

	<div class="center">
		
	<?php if($_SESSION['flag_admin'] == 0) { ?>

		<p>Welcome, <?php echo $_SESSION['name']."!"; ?></p>
	</div>
	<form class="form-signin" action="doAssessment.php" method="post">
		<div class="drop">
			<button type="button" class="btn-basic dropBtn" name="doAssessment" >Take the test <i class="arrowDown"></i></button>
			<div class="dropDownGroup">
			<?php foreach($getSubjects as $subject) { ?>
				<button type="submit" class="btn-basic" name="subjectId" value="<?php echo $subject['subject_id']; ?>" ><?php echo $subject['description']; ?></button>
			<?php } ?>
			</div>
		</div>
	</form>
	<form class="form-signin" action="userForm.php" method="get">
		<button type="submit" class="btn-basic" name="editProfile" >Edit Profile</button>
        <input type="hidden" name="username" value="<?php echo $username?>">
	</form>
    <form class="form-signin" action="userAttempts.php" method="get">
        <button type="submit" class="btn-basic" name="lastestResults" >Lastest Results</button>
    </form>
	<form class="form-signin" action="index.php" method="post">
		<button type="submit" class="btn-basic" name="signOut" >Sign out</button>
	</form>
	<?php } else {?>

		<p>Welcome to Administration Area, <?php echo $_SESSION['name']."!"; ?></p>
	</div>
	<form class="form-signin" action="editQnS.php" method="get">
		<button type="submit" class="btn-basic" name="editSubjects" >Edit Subjects</button>
	</form>
	<form class="form-signin" action="editQnS.php" method="get">
		<div class="drop">
		<button type="button" class="btn-basic dropBtn" name="" >Edit Questions</button>
			<div class="dropDownGroup">
			<?php foreach($getSubjects as $subject) { ?>
				<button type="submit" class="btn-basic" name="questSubjectId" value="<?php echo $subject['subject_id']; ?>" ><?php echo $subject['description']; ?></button>
			<?php } ?>
			</div>
		</div>
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