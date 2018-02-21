<?php 
session_start();
require_once('model/database.php');
require_once('model/question_db.php');
require_once('model/subject_db.php');

include 'view/header.php';
if (!isset($subjectId)) { $subjectId = "1"; }

if (isset($_POST["SubjectInsert"])) {
    add_subject($_POST["description"]);
} else if (isset($_POST["SubjectUpdate"])) {
    update_subject($_POST["id"], $_POST["description"], 1);
} else if (isset($_POST["SubjectDelete"])) {
    delete_subject($_POST["id"]);
}

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

        function deleteQuestion(questionId){
            createFormWithParametersAndSubmit('deleteQuestion.php', 'post', 'questionIdToDelete', questionId);
        };
    
        function addSubject(event) {
            event.preventDefault();
            
			var table = document.getElementById("tableSubjects");
			var id = table.rows.length;
			var row1 = table.insertRow(id);
            
			var idCell = row1.insertCell(0);
			var subject = row1.insertCell(1);
			var buttonCell = row1.insertCell(2);
            buttonCell.classList.add("table-edit-button-cell");
            
            idCell.innerHTML = "new";
            
			subject.classList.add("table-cell-question");
            var textInput = document.createElement("INPUT");
			textInput.setAttribute("type", "text");
			textInput.name = id;
            textInput.id = "new " + id;
            textInput.classList.add("input-form", "input-100");
			textInput.required = true;
            textInput.autofocus = true;
			subject.appendChild(textInput);
            
            var okButton = createButton("ok", id);
            okButton.addEventListener("click", function(ev) {
                upsertSubject(ev, this);
			});
			buttonCell.appendChild(okButton);
        }
    
        function createButton(iconType, id) {
            var button = document.createElement("INPUT");
            button.setAttribute("type", "image");
            button.src = "images/" + iconType + "-icon.png";
            button.alt = iconType + " button";
            button.height = "30";
            button.width = "30";
            button.classList.add("alignBottomImg", "cursor");
            button.value = "new " + id;
            return button;
        }
    
        function upsertSubject(event, button) {
            event.preventDefault();
            
            if (button.alt == "ok button") {
                var success = true;
                var params = [];
                
                if (button.value.split(" ")[0] == "new") { //insert subject
                    var textInput = document.getElementById(button.value);
                    var description = textInput.value;
                    var param1 = createInputParameter("SubjectInsert", "1");
                    var param2 = createInputParameter("description", description);
                    params = [param1, param2];
                } else { // update subject
                    var id = button.value;
                    var textInput = document.getElementById(id);
                    var description = textInput.value;
                    var param1 = createInputParameter("SubjectUpdate", "1");
                    var param2 = createInputParameter("id", id);
                    var param3 = createInputParameter("description", description);
                    params = [param1, param2, param3];
                }
                
                createFormAndSubmit("editQnS.php", "post", params);
            } else if (button.alt == "edit button") { //enable edit mode
                button.src = "images/ok-icon.png";
                button.alt = "ok button";
                var id = button.value;
                var textInput = document.getElementById(id);
                textInput.readOnly = false;
            }
        }

        function deleteSubject(button){
            var param1 = createInputParameter("SubjectDelete", "1");
            var param2 = createInputParameter("id", button.value);
            var params = [param1, param2];
            createFormAndSubmit("editQnS.php", "post", params);
        }
    
        function createInputParameter(name, value) {
            var inputParameter = document.createElement('input');
            inputParameter.setAttribute('type', 'text');
            inputParameter.setAttribute('name', name);
            inputParameter.setAttribute('value', value);
            return inputParameter;
        }
    
        function createFormAndSubmit(url, method, parameters) {
            var form = document.createElement('form');
            form.setAttribute('action', url);
            form.setAttribute('method', method);
            form.setAttribute('hidden', 'true');

            for (i = 0; i < parameters.length; i++) {
                form.appendChild(parameters[i]);
            }
            
            document.body.appendChild(form);
            form.submit();
        }
    </script>
<section>

<form class="form-editQS" action="saveQnS.php" method="post">
<?php if (isset($_GET['editSubjects']) || isset($_POST["SubjectInsert"]) || isset($_POST["SubjectUpdate"]) || isset($_POST["SubjectDelete"])) {

	$subjects = get_subjects();
    
    if (count($subjects) > 0) {
?>
    
    <table class="table-edit" id="tableSubjects">
        <thead>
            <tr>
                <th>Id</th>
                <th>Subject</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($subjects as $subject) { ?>
            <tr>
                <td><?php echo $subject['subject_id'];?></td>
                <td class="table-cell-question"><input class="input-form input-100" type="text" name="<?php echo $subject['subject_id'];?>" value="<?php echo htmlspecialchars($subject['description']);?>" id="<?php echo $subject['subject_id'];?>" readonly required/></td>
                <td class="table-edit-button-cell"><input type="image" src="images/edit-icon.png" alt="edit button" height="30" width="30" class="alignBottomImg cursor" onclick="upsertSubject(event, this)" value="<?php echo $subject['subject_id'];?>"/></td>
                <td class="table-edit-button-cell"><input type="image" src="images/delete-icon.png" alt="Delete" height="30" width="30" class="alignBottomImg cursor" onclick="createModal(event, 'Are you sure you want to delete the subject?', '<?php echo $subject['subject_id'] . ' - ' . $subject['description'];?>', this, deleteSubject)" value="<?php echo $subject['subject_id'];?>"/></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
    <p class="center">There is no subjects.</p>
    <?php } ?>
	<div class="center">
        <button type="submit" class="btn-basic center" name="add" onclick="addSubject(event);">Add Subject</button>
    </div>

<?php } ?>



<?php if (isset($_GET['questSubjectId'])) {
	$subjectId = $_GET['questSubjectId'];
	$questions = get_questions_by_subject($subjectId);
    
    if (count($questions) > 0) {
?> 

	<table class="table-edit" id="tableQuestions">
        <thead>
            <tr>
                <th>Id</th>
                <th>Question</th>
                <th></th>
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
                <td><input type="image" src="images/edit-icon.png" alt="Edit" height="30" width="30" class="alignBottomImg cursor" onclick="editQuestion(event, <?php echo $question['question_id'];?>)"/></td>
                <td><input type="image" src="images/delete-icon.png" alt="Delete" height="30" width="30" class="alignBottomImg cursor" id="deleteButton" onclick="createModal(event, 'Are you sure you want to delete the question?', '<?php echo $question['question_id'] . ' - ' . $question['description'];?>', <?php echo $question['question_id'];?>, deleteQuestion)"/></td>
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
    <?php } else { ?>
    <p class="center">There is no questions for this subject.</p>
    <?php } ?>
    <div class="center">
        <button type="submit" class="btn-basic center" name="add" onclick="newQuestion(event, <?php echo $subjectId ?>)">Add Question</button>
    </div>

<?php } ?>
</form>
    <form class="form-editQS center " action="userArea.php" method="post">
		<button type="submit" class="btn-basic" name="back">Back to Menu</button>
	</form>
</section>
<script src="js/modal.js"></script>
<?php include 'view/footer.php'; ?>