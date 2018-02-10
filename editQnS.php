<?php 

require_once('model/database.php');
require_once('model/question_db.php');
require_once('model/subject_db.php');

include 'view/header.php';

$questions = get_questions_by_subject("1");
?>
<script>
        function toggleOptions(element) {
            var optionsSet = document.getElementById(element.value);
            if (optionsSet.style.display == "block") {
                optionsSet.style.display = "none";
                element.src = "images/arrow-down-icon.png";
            } else {
                optionsSet.style.display = "block";
                element.src = "images/arrow-up-icon.png";
            }
        }
    </script>
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
?> 

	<table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Description</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($questions as $question) { ?>
            <tr>
                <td><?php echo htmlspecialchars($question['question_id']);?></td>
                <td class="table-cell-question" contenteditable="true"><?php echo htmlspecialchars($question['description']);?></td>
                <td><input type="image" src="images/arrow-down-icon.png" alt="Collapse" height="45" width="45" class="alignBottomImg cursor" value="<?php echo $question['question_id'];?>" onclick="toggleOptions(this)"/></td>
                <td><input type="image" src="images/delete-icon.png" alt="Delete" height="45" width="45" class="alignBottomImg cursor"/></td>
            </tr>
            <tr >
                <td></td>
                <td class="table-cell-options" id="<?php echo $question['question_id'];?>" style="display: none;">
                    <ol type="a">
                        <li><input type="text" class="input-user-resgistration editOptions fontSmaller" name="<?php echo $question['question_id'];?>" value="<?php echo htmlspecialchars($question['optionA']); ?>"/></li>
                        <li><input type="text" class="input-user-resgistration editOptions fontSmaller" name="<?php echo $question['question_id'];?>" value="<?php echo htmlspecialchars($question['optionB']); ?>"/></li>
                        <li><input type="text" class="input-user-resgistration editOptions fontSmaller" name="<?php echo $question['question_id'];?>" value="<?php echo htmlspecialchars($question['optionC']); ?>"/></li>
                        <li><input type="text" class="input-user-resgistration editOptions fontSmaller" name="<?php echo $question['question_id'];?>" value="<?php echo htmlspecialchars($question['optionD']); ?>"/></li>
                    </ol>
                </td>
                <td></td>
                <td></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

	<img src="images/add-icon.png" alt="Add" height="45" width="45" class="cursor addIcon">

<?php } ?>
<div class="center">
	<button type="submit" class="btn-basic" name="save" >Save</button>
</div>
</form>
</section>

<?php include 'view/footer.php'; ?>