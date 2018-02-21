<?php 
session_start();
require_once('model/database.php');
require_once('model/subject_db.php');
require_once('model/result_db.php');

$getSubjects = get_subjects();

//echo "<pre>";
//print_r($_POST);
//echo "</pre>";

$getResults = array();
if (isset($_POST['filterReport'])) {
	$getResults = get_results_for_report($_POST['subject'], $_POST['date']);
	
	if (!empty($_POST['subject'])) {
		$subject_id = $_POST['subject'];
		$subject_desc = get_subject($subject_id);
	}
}

//echo "<pre>";
//print_r($getResults);
//echo "</pre>";

$success = 0;
$fail = 0;
$avg = 0;
$total = 0;
$doingTest = 0;
$abortedTest = 0;

if (!empty($getResults)) {
	//$total = count($getResults);

	foreach ($getResults as $result) {
		if ($result['status'] == 'DOING') {
			$doingTest++;
		} else if ($result['status'] == 'ABORTED') {
			$abortedTest++;
		} else if ($result['status'] == 'DONE') {
			 if ($result['grade'] > 7) {
				$success++;
			} else {
				$fail++;
			}
			$avg += $result['grade'];
			$total++;
		}
	}
	if ($total != 0) {
		$avg = $avg/$total;
	}
}

include 'view/header.php'; ?>

<section>
	<form class="form-questions">
		<table class="table-report center-margin">
			<tr>
				<td nowrap>Users Successfully: <?php echo $success; ?></td>
				<td nowrap>Users Fail: <?php echo $fail; ?></td>
				<td nowrap>Users Average: <?php echo number_format($avg,2); ?></td>
				<td nowrap>Users doing the test: <?php echo $doingTest; ?></td>
				<td nowrap>Aborted tests: <?php echo $abortedTest; ?></td>
			</tr>
		</table>
	</form>
	<hr>
	<form class="form-questions center" action="report.php" method="post">
		<label class="label-report">Test: </label>
        <select name="subject" class="input-form option-filter">
        	<option value="<?php echo (isset($_POST['subject'])) ? $_POST['subject'] : "";?>"><?php echo (!empty($_POST['subject'])) ? $subject_desc['description'] : "";?></option>
        	<?php foreach($getSubjects as $subject) { ?>
        		<option  value="<?php echo $subject['subject_id']; ?>"><?php echo $subject['description']; ?></option>
        	<?php } ?>
        </select>
        <label class="label-report">Date: </label>
        <input type="date" name="date" class="input-form" value="<?php echo (!empty($_POST['date'])) ? $_POST['date'] : "";?>">
		<button type="submit" class="btn-basic btn-filter" name="filterReport" >Ok</button>

		<?php 
		if (isset($_POST['filterReport'])) { ?>

		<table class="table-report center-margin">
			<?php if (empty($getResults)) { ?>
				<tr>
					<th nowrap colspan="3">Sorry, there are no results to show</th>
				</tr>
			<?php } else { ?>
				<tr>
					<th nowrap>User</th>
					<th nowrap>Subject</th>
					<th nowrap>Grade</th>
					<th nowrap>Status</th>
				</tr>
				<?php if (empty($_POST['subject']) && empty($_POST['date'])) { ?>
					<?php foreach($getResults as $result) { ?>
					<tr>
						<td nowrap><?php echo $result['first_name']." ".$result['last_name']; ?></td>
						<td nowrap><?php echo $result['description']; ?></td>
						<td nowrap><?php echo $result['grade']; ?></td>
						<td nowrap><?php echo $result['status']; ?></td>
					</tr>
					<?php } ?>
				<?php } else if (!empty($_POST['subject'])) { ?>
					<?php foreach($getResults as $result) { ?>
						<?php if($result['status'] == 'DONE') { ?>
						<tr>
							<td nowrap><?php echo $result['first_name']." ".$result['last_name']; ?></td>
							<td nowrap><?php echo $result['description']; ?></td>
							<td nowrap><?php echo $result['grade']; ?></td>
							<td nowrap><?php echo $result['status']; ?></td>
						</tr>
						<?php } ?>
					<?php } ?>
				<?php } else if (!empty($_POST['date'])) { 
					$date = $_POST['date'] ?? '';?>
					
					<?php foreach($getResults as $result) { ?>
						<?php if($result['status'] == 'DONE') { ?>
						<tr>
							<td nowrap><?php echo $result['first_name']." ".$result['last_name']; ?></td>
							<td nowrap><?php echo $result['description']; ?></td>
							<td nowrap><?php echo $result['grade']; ?></td>
							<td nowrap><?php echo $result['status']; ?></td>
						</tr>
						<?php } ?>
					<?php } ?>
				<?php } else if (!empty($_POST['subject_id']) && !empty($_POST['date'])) { ?>
					<?php foreach($getResults as $result) { ?>
						<?php if($result['status'] == 'DONE') { ?>
						<tr>
							<td nowrap><?php echo $result['first_name']." ".$result['last_name']; ?></td>
							<td nowrap><?php echo $result['description']; ?></td>
							<td nowrap><?php echo $result['grade']; ?></td>
							<td nowrap><?php echo $result['status']; ?></td>
						</tr>
						<?php } ?>
					<?php } ?>
				<?php } ?>
			<?php } ?>
		</table>

		<?php } ?>

	</form>
	<form class="form-signin center" action="userArea.php" method="post">
		<button type="submit" class="btn-basic input-80" name="back">Back to Menu</button>
	</form>
</section>

<?php include 'view/footer.php'; ?>