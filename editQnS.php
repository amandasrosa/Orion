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
            var optionsSet = document.getElementById("options" + element.value);
            if (optionsSet.style.display == "block") {
                optionsSet.style.display = "none";
                document.getElementById(element.value).src = "images/arrow-down-icon.png";
            } else {
                optionsSet.style.display = "block";
                document.getElementById(element.value).src = "images/arrow-up-icon.png";
            }
        }
		
        function createFormWithParametersAndSubmit(url, method, paramName, paramValue) {
            var form = document.createElement('form');
            form.setAttribute('action', url);
            form.setAttribute('method', method);
            form.setAttribute('hidden', 'true');

            var inputParameter = document.createElement('input');
            inputParameter.setAttribute('type', 'text');
            inputParameter.setAttribute('name', paramName);
            inputParameter.setAttribute('value', paramValue);

            form.appendChild(inputParameter);
            document.body.appendChild(form);

            form.submit();
        }

        function editQuestion(event, questionId){
            event.preventDefault();
            createFormWithParametersAndSubmit('upsertQuestion.php', 'get', 'questionId', questionId);
        };

        function newQuestion(event, subjectId){
            event.preventDefault();
            createFormWithParametersAndSubmit('upsertQuestion.php', 'get', 'subjectId', subjectId);
        };

        function deleteQuestion(event, questionId){
            event.preventDefault();
            createFormWithParametersAndSubmit('deleteQuestion.php', 'post', 'questionIdToDelete', questionId);
        };
    </script>
<section>

<form class="form-editQS" action="saveQnS.php" method="post">
<?php if (isset($_GET['editSubjects'])) {

	$subjects = get_subjects();

	foreach ($subjects as $subject) { ?>
	<div>
		<input type="text" class="input-form input-60 fontSmaller" name="<?php echo htmlspecialchars($subject['subject_id']);?>" value="<?php echo htmlspecialchars($subject['description']); ?>"/>
		<img src="images/delete-icon.png" alt="Delete" height="45" width="45" class="alignBottomImg cursor">
	</div>
	<?php }?>
	<div class="center">
        <button type="submit" class="btn-basic center" name="add" >Add Subject</button>
    </div>

<?php } ?>



<?php if (isset($_GET['questSubjectId'])) {
	$subjectId = $_GET['questSubjectId'];
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
                <td class="table-cell-question"><button class="collapsible" onclick="toggleOptions(this);return false;" value="<?php echo $question['question_id'];?>"><?php echo htmlspecialchars($question['description']);?></button></td>
                <td><input type="image" src="images/arrow-down-icon.png" alt="Collapse" height="45" width="45" class="alignBottomImg cursor" value="<?php echo $question['question_id'];?>" onclick="toggleOptions(this);return false;" id="<?php echo $question['question_id'];?>"/></td>
                <td><input type="image" src="images/delete-icon.png" alt="Delete" height="45" width="45" class="alignBottomImg cursor" onclick="deleteQuestion(event, <?php echo $question['question_id'];?>)"/></td>
                <td><input type="image" src="images/edit-icon.png" alt="Edit" height="30" width="30" class="alignBottomImg cursor" onclick="editQuestion(event, <?php echo $question['question_id'];?>)"/></td>
            </tr>
            <tr >
                <td></td>
                <td class="table-cell-options" id="options<?php echo $question['question_id'];?>" style="display: none;">
                    <ol type="a">
						<li><input type="radio" name="<?php echo $question["question_id"]; ?>" value="a" id="<?php echo $question["question_id"]; ?>a" <?php echo $question["answer"] == 'a' ? 'checked' : 'disabled'; ?>/>
                        <label class="fontSmaller" for="<?php echo $question['question_id'];?>a"><?php echo htmlspecialchars($question['optionA']); ?></label></li>
                        <li><input type="radio" name="<?php echo $question["question_id"]; ?>" value="b" id="<?php echo $question["question_id"]; ?>b" <?php echo $question["answer"] == 'b' ? 'checked' : 'disabled'; ?>>
						<label class="fontSmaller" for="<?php echo $question['question_id'];?>b"><?php echo htmlspecialchars($question['optionB']); ?></label></li>
                        <li><input type="radio" name="<?php echo $question["question_id"]; ?>" value="c" id="<?php echo $question["question_id"]; ?>c" <?php echo $question["answer"] == 'c' ? 'checked' : 'disabled'; ?>>
						<label class="fontSmaller" for="<?php echo $question['question_id'];?>c"><?php echo htmlspecialchars($question['optionC']); ?></label></li>
                        <li><input type="radio" name="<?php echo $question["question_id"]; ?>" value="d" id="<?php echo $question["question_id"]; ?>d" <?php echo $question["answer"] == 'd' ? 'checked' : 'disabled'; ?>>
						<label class="fontSmaller" for="<?php echo $question['question_id'];?>d"><?php echo htmlspecialchars($question['optionD']); ?></label></li>
                    </ol>
                </td>
                <td></td>
                <td></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="center">
        <button type="submit" class="btn-basic center" name="add" onclick="newQuestion(event, <?php echo $subjectId ?>)">Add Question</button>
    </div>

<?php } ?>
</form>
    <form class="form-editQS center " action="userArea.php" method="post">
		<button type="submit" class="btn-basic" name="back">Back to Menu</button>
	</form>
</section>

<?php include 'view/footer.php'; ?>