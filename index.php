<?php
    session_start();
    session_destroy();
	require_once('model/database.php');
	require_once('model/question_db.php');
	require_once('model/result_db.php');
	require_once('model/subject_db.php');
	require_once('model/user_db.php');
	include 'view/header.php';
?>


    <section class="form-signin form-login">

        <form action="userArea.php" method="post">
            <h1>Welcome!</h1>

            <input type="text" id="inputUsername" name="username" class="input-user-login input-user-resgistration" placeholder="Username" required autofocus>
            <input type="password" id="inputPassword" name="password" class="input-user-login input-user-resgistration" placeholder="Password" required>

            <button class="btn-basic btn-login" type="submit" name="signIn">Sign in</button>
        </form>
        <form action="userForm.php" method="post">
            <button class="btn-basic btn-login" type="submit" name="register">Register</button>
        </form>

    </section>


<?php include 'view/footer.php'; ?>