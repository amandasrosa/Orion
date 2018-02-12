<?php 
session_start();
require_once('model/database.php');
require_once('model/result_db.php');

$results = get_results();
$success = 0;
$fail = 0;
$avg = 0;
$total = 0;
$doingTest = 0;

if (!empty($results)) {
	$total = count($results);

	foreach ($results as $result) {
		if ($result['grade'] == null) {
			$doingTest++;
		} else if ($result['grade'] > 7) {
			$success++;
		} else {
			$fail++;
		}
		$avg += $result['grade'];
	}
	$avg = $avg/$total;
}

include 'view/header.php'; ?>

<section>
	<form class="form-signin" action="filterReport.php" method="post">
		<h1>Users Successfully: <?php echo $success; ?></h1>
		<h1>Users Fail: <?php echo $fail; ?></h1>
		<h1>Users Average: <?php echo $avg; ?></h1>
		<h1>Users doing the test: <?php echo $doingTest; ?></h1>
		<button type="submit" class="btn-basic" name="filterReport" >Filter Report</button>
	</form>
	<form class="form-signin" action="userArea.php" method="post">
		<button type="submit" class="btn-basic" name="back">Back to Menu</button>
	</form>
</section>

<?php include 'view/footer.php'; ?>