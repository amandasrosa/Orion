<?php 
session_start();
require_once('model/database.php');
require_once('model/question_db.php');
require_once('model/subject_db.php');

include 'view/header.php';
if (!isset($subjectId)) { $subjectId = "1"; }
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
	<div class="center">
        <button type="submit" class="btn-basic center" name="add" >Add Subject</button>
    </div>

<?php } ?>



<?php if (isset($_POST['questSubjectId'])) { 
	$subjectId = $_POST['questSubjectId'];
	$questions = get_questions_by_subject($subjectId);
?> 

	<table class="table-edit" id="tableQuestions">
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
                <td><input type="image" src="images/arrow-down-icon.png" alt="Collapse" height="45" width="45" class="alignBottomImg cursor" value="<?php echo $question['question_id'];?>" onclick="toggleOptions(this);return false;"/></td>
                <td><input type="image" src="images/delete-icon.png" alt="Delete" height="45" width="45" class="alignBottomImg cursor" onclick="return false;"/></td>
            </tr>
            <tr >
                <td></td>
                <td class="table-cell-options" id="<?php echo $question['question_id'];?>" style="display: none;">
                    <ol type="a">
						<li><input type="radio" name="<?php echo $question["question_id"]; ?>" value="a" id="<?php echo $question["question_id"]; ?>a" <?php echo $question["answer"] == 'a' ? 'checked' : ''; ?>/>
						<input type="text" class="input-user-resgistration editOptions fontSmaller" name="<?php echo $question['question_id'];?>" value="<?php echo htmlspecialchars($question['optionA']); ?>"/></li>
                        <li><input type="radio" name="<?php echo $question["question_id"]; ?>" value="b" id="<?php echo $question["question_id"]; ?>b" <?php echo $question["answer"] == 'b' ? 'checked' : ''; ?>>
						<input type="text" class="input-user-resgistration editOptions fontSmaller" name="<?php echo $question['question_id'];?>" value="<?php echo htmlspecialchars($question['optionB']); ?>"/></li>
                        <li><input type="radio" name="<?php echo $question["question_id"]; ?>" value="c" id="<?php echo $question["question_id"]; ?>c" <?php echo $question["answer"] == 'c' ? 'checked' : ''; ?>>
						<input type="text" class="input-user-resgistration editOptions fontSmaller" name="<?php echo $question['question_id'];?>" value="<?php echo htmlspecialchars($question['optionC']); ?>"/></li>
                        <li><input type="radio" name="<?php echo $question["question_id"]; ?>" value="d" id="<?php echo $question["question_id"]; ?>d" <?php echo $question["answer"] == 'd' ? 'checked' : ''; ?>>
						<input type="text" class="input-user-resgistration editOptions fontSmaller" name="<?php echo $question['question_id'];?>" value="<?php echo htmlspecialchars($question['optionD']); ?>"/></li>
                    </ol>
                </td>
                <td></td>
                <td></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="center">
        <button type="submit" class="btn-basic center" name="add" onclick="return false;">Add Question</button>
    </div>

<?php } ?>
<div class="center">
	<button type="submit" class="btn-basic" name="save" >Save</button>
</div>
</form>
    <form class="form-editQS center " action="userArea.php" method="post">
		<button type="submit" class="btn-basic" name="back">Back to Menu</button>
	</form>
</section>

<?php include 'view/footer.php'; ?>