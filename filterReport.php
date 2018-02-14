<?php 
session_start();
require_once('model/database.php');
require_once('model/subject_db.php');
require_once('model/result_db.php');

$getSubjects = get_subjects();
include 'view/header.php'; ?>

<section>

	<form class="" action="filterReport.php" method="post">
		<label class="sr-only">Test: </label>
        <input type="text" name="subject" class="">
        <select>
        	<?php foreach($getSubjects as $subject) { ?>
        		<option value="<?php echo $subject['subject_id']; ?>"><?php echo $subject['description']; ?></option>
        	<?php } ?>
        </select>
        <label class="sr-only">Date: </label>
        <input type="text" name="username" class="">
		<button type="submit" class="btn-basic" name="filterReport" >Ok</button>
	</form>

	<form class="form-signin" action="userArea.php" method="post">
		<button type="submit" class="btn-basic" name="back">Back to Menu</button>
	</form>


</section>

<?php include 'view/footer.php'; ?>