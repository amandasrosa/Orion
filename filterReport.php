<?php 
require_once('model/database.php');
require_once('model/subject_db.php');
require_once('model/result_db.php');

$subjects = get_subjects();
include 'view/header.php'; ?>

<section>

	<form class="" action="filterReport.php" method="post">
		<label class="sr-only">Test: </label>
        <input type="text" name="subject" class="">
        <label class="sr-only">Date: </label>
        <input type="text" name="username" class="">
		<button type="submit" class="btn-basic" name="filterReport" >Ok</button>
	</form>

	<form class="form-signin" action="userArea.php" method="post">
		<button type="submit" class="btn-basic" name="back">Back to Menu</button>
	</form>


</section>

<?php include 'view/footer.php'; ?>