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
		
		function addQuestion() {
			var table = document.getElementById("tableQuestions");
			var id = table.rows.length;
			var row1 = table.insertRow(id);
			
			row1.insertCell(0);
			var question = row1.insertCell(1);
			var collapseCell = row1.insertCell(2);
			var deleteCell = row1.insertCell(3);

			question.classList.add("table-cell-question");
			question.contentEditable = "true";
			question.focus();
			
			var collapseButton = document.createElement("INPUT");
			collapseButton.setAttribute("type", "image");
			collapseButton.src = "images/arrow-up-icon.png";
			collapseButton.alt = "Collapse";
			collapseButton.height = "45";
			collapseButton.width = "45";
			collapseButton.classList.add("alignBottomImg", "cursor");
			collapseButton.value = "e" + id;
			collapseButton.addEventListener("click", function(ev) {
				ev.preventDefault();
				toggleOptions(ev.target);
			});
			collapseCell.appendChild(collapseButton);
			
			var deleteButton = document.createElement("INPUT");
			deleteButton.setAttribute("type", "image");
			deleteButton.src = "images/delete-icon.png";
			deleteButton.alt = "Delete";
			deleteButton.height = "45";
			deleteButton.width = "45";
			deleteButton.classList.add("alignBottomImg", "cursor");
			deleteButton.value = "e" + id;
			deleteButton.addEventListener("click", function(ev) {
				ev.preventDefault();
			});
			deleteCell.appendChild(deleteButton);
			
			var row2 = table.insertRow(id+1);
			row2.insertCell(0);
			var optionsCell = row2.insertCell(1);
			row2.insertCell(2);
			row2.insertCell(3);
			
			optionsCell.id = "e" + id;
			optionsCell.style.display = "block";
			optionsCell.classList.add("table-cell-options");
			var optionList = document.createElement("OL");
			optionList.type = "a";
			
			var optionA = document.createElement("LI");
			var radioA = document.createElement("INPUT");
			radioA.setAttribute("type", "radio");
			radioA.name = id;
			radioA.value = id + "a";
			radioA.required;
			optionA.appendChild(radioA);
			var textA = document.createElement("INPUT");
			textA.setAttribute("type", "text");
			textA.name = id + "a";
			textA.required;
			optionA.appendChild(textA);
			
			var optionB = document.createElement("LI");
			var radioB = document.createElement("INPUT");
			radioB.setAttribute("type", "radio");
			radioB.name = id;
			radioB.value = id + "b";
			radioB.required;
			optionB.appendChild(radioB);
			var textB = document.createElement("INPUT");
			textB.setAttribute("type", "text");
			textB.name = id + "b";
			textB.required;
			optionB.appendChild(textB);
			
			var optionC = document.createElement("LI");
			var radioC = document.createElement("INPUT");
			radioC.setAttribute("type", "radio");
			radioC.name = id;
			radioC.value = id + "c";
			radioC.required;
			optionC.appendChild(radioC);
			var textC = document.createElement("INPUT");
			textC.setAttribute("type", "text");
			textC.name = id + "c";
			textC.required;
			optionC.appendChild(textC);
			
			var optionD = document.createElement("LI");
			var radioD = document.createElement("INPUT");
			radioD.setAttribute("type", "radio");
			radioD.name = id;
			radioD.value = id + "d";
			radioD.required;
			optionD.appendChild(radioD);
			var textD = document.createElement("INPUT");
			textD.setAttribute("type", "text");
			textD.name = id + "d";
			textD.required;
			optionD.appendChild(textD);
			
			optionList.appendChild(optionA);
			optionList.appendChild(optionB);
			optionList.appendChild(optionC);
			optionList.appendChild(optionD);
			optionsCell.appendChild(optionList);
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
                <td class="table-cell-question" contenteditable="true"><?php echo htmlspecialchars($question['description']);?></td>
                <td><input type="image" src="images/arrow-down-icon.png" alt="Collapse" height="45" width="45" class="alignBottomImg cursor" value="<?php echo $question['question_id'];?>" onclick="toggleOptions(this);return false;"/></td>
                <td><input type="image" src="images/delete-icon.png" alt="Delete" height="45" width="45" class="alignBottomImg cursor" onclick="deleteQuestion(event, <?php echo $question['question_id'];?>)"/></td>
                <td><input type="image" src="images/edit-icon.png" alt="Edit" height="30" width="30" class="alignBottomImg cursor" onclick="editQuestion(event, <?php echo $question['question_id'];?>)"/></td>
            </tr>
            <tr >
                <td></td>
                <td class="table-cell-options" id="<?php echo $question['question_id'];?>" style="display: none;">
                    <ol type="a">
						<li><input type="radio" name="<?php echo $question["question_id"]; ?>" value="a" id="<?php echo $question["question_id"]; ?>a" <?php echo $question["answer"] == 'a' ? 'checked' : ''; ?>/>
						<input type="text" class="input-form input-60 editOptions fontSmaller" name="<?php echo $question['question_id'];?>a" value="<?php echo htmlspecialchars($question['optionA']); ?>"/></li>
                        <li><input type="radio" name="<?php echo $question["question_id"]; ?>" value="b" id="<?php echo $question["question_id"]; ?>b" <?php echo $question["answer"] == 'b' ? 'checked' : ''; ?>>
						<input type="text" class="input-form input-60 editOptions fontSmaller" name="<?php echo $question['question_id'];?>b" value="<?php echo htmlspecialchars($question['optionB']); ?>"/></li>
                        <li><input type="radio" name="<?php echo $question["question_id"]; ?>" value="c" id="<?php echo $question["question_id"]; ?>c" <?php echo $question["answer"] == 'c' ? 'checked' : ''; ?>>
						<input type="text" class="input-form input-60 editOptions fontSmaller" name="<?php echo $question['question_id'];?>c" value="<?php echo htmlspecialchars($question['optionC']); ?>"/></li>
                        <li><input type="radio" name="<?php echo $question["question_id"]; ?>" value="d" id="<?php echo $question["question_id"]; ?>d" <?php echo $question["answer"] == 'd' ? 'checked' : ''; ?>>
						<input type="text" class="input-form input-60 editOptions fontSmaller" name="<?php echo $question['question_id'];?>d" value="<?php echo htmlspecialchars($question['optionD']); ?>"/></li>
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
<div class="center">

    <button type="submit" class="btn-basic" name="save" >Save</button>

</div>
</form>
    <form class="form-editQS center " action="userArea.php" method="post">
		<button type="submit" class="btn-basic" name="back">Back to Menu</button>
	</form>
</section>

<?php include 'view/footer.php'; ?>