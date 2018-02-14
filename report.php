<?php 
session_start();
require_once('model/database.php');
require_once('model/subject_db.php');
require_once('model/result_db.php');

$getSubjects = get_subjects();
$getResults = get_results_for_report();

//echo "<pre>";
//print_r($_POST);
//echo "</pre>";

$success = 0;
$fail = 0;
$avg = 0;
$total = 0;
$doingTest = 0;

if (!empty($getResults)) {
	$total = count($getResults);

	foreach ($getResults as $result) {
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
	<form class="form-questions">
		<table class="table-report center-margin">
			<tr>
				<td nowrap>Users Successfully: <?php echo $success; ?></td>
				<td nowrap>Users Fail: <?php echo $fail; ?></td>
				<td nowrap>Users Average: <?php echo $avg; ?></td>
				<td nowrap>Users doing the test: <?php echo $doingTest; ?></td>
			</tr>
		</table>
	</form>
	<hr>
	<form class="form-questions center" action="report.php" method="post">
		<label class="label-report">Test: </label>
        <select name="subject" class="input-user-resgistration option-filter">
        	<option  value=""></option>
        	<?php foreach($getSubjects as $subject) { ?>
        		<option  value="<?php echo $subject['subject_id']; ?>"><?php echo $subject['description']; ?></option>
        	<?php } ?>
        </select>
        <label class="label-report">Date: </label>
        <input type="text" name="date" class="" value="">
		<button type="submit" class="btn-basic btn-filter" name="filterReport" >Ok</button>

		<?php 
		
		//tratar caso nao retorne resultados
		//trocar isset to empty

		if (isset($_POST['filterReport'])) { ?>

		<table class="table-report center-margin">
			<?php if (empty($_POST['subject']) && empty($_POST['date'])) { ?>
				<tr>
					<td nowrap>User</td>
					<td nowrap>Subject</td>
					<td nowrap>Grade</td>
				</tr>
				<?php foreach($getResults as $result) { ?>
				<tr>
					<td nowrap><?php echo $result['first_name']." ".$result['last_name']; ?></td>
					<td nowrap><?php echo $result['description']; ?></td>
					<td nowrap><?php echo $result['grade']; ?></td>
				</tr>
				<?php } ?>
			<?php } ?>
			<?php if (isset($_POST['subject'])) { 
				 $subjectt = $_POST['subject'] ?? '';?>
				 <tr>
					<td nowrap>User</td>
					<td nowrap>Subject</td>
					<td nowrap>Grade</td>
				</tr>
				<?php foreach($getResults as $result) { ?>
					<?php if($result['subject_id'] == $subjectt) { ?>
					<tr>
						<td nowrap><?php echo $result['first_name']." ".$result['last_name']; ?></td>
						<td nowrap><?php echo $result['description']; ?></td>
						<td nowrap><?php echo $result['grade']; ?></td>
					</tr>
					<?php } ?>
				<?php } ?>
			<?php } ?>
			<?php if (isset($_POST['date'])) { 
				$date = $_POST['date'] ?? '';?>
				<tr>
					<td nowrap>User</td>
					<td nowrap>Subject</td>
					<td nowrap>Grade</td>
				</tr>
				<?php foreach($getResults as $result) { ?>
					<?php if($result['testDate'] == $date) { ?>
					<tr>
						<td nowrap><?php echo $result['first_name']." ".$result['last_name']; ?></td>
						<td nowrap><?php echo $result['description']; ?></td>
						<td nowrap><?php echo $result['grade']; ?></td>
					</tr>
					<?php } ?>
				<?php } ?>
			<?php } ?>
			<?php if (isset($_POST['subject_id']) && isset($_POST['date'])) { 
				$subjectt = $_POST['subject_id'] ?? '';
				$date = $_POST['date'] ?? '';?>
				<tr>
					<td nowrap>User</td>
					<td nowrap>Subject</td>
					<td nowrap>Grade</td>
				</tr>
				<?php foreach($getResults as $result) { ?>
					<?php if( ($result['subject_id'] == $subjectt) && ($result['testDate'] == $date) ) { ?>
					<tr>
						<td nowrap><?php echo $result['first_name']." ".$result['last_name']; ?></td>
						<td nowrap><?php echo $result['description']; ?></td>
						<td nowrap><?php echo $result['grade']; ?></td>
					</tr>
					<?php } ?>
				<?php } ?>
			<?php } ?>
		</table>

		<?php } ?>

	</form>
	<form class="form-signin center" action="userArea.php" method="post">
		<button type="submit" class="btn-basic" name="back">Back to Menu</button>
	</form>
</section>

<?php include 'view/footer.php'; ?>