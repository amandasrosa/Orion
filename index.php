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

<div class="center-form-horizontally">
    <section class="form-signin form-login">

        <form action="userArea.php" method="post">
            <h1>Welcome!</h1>

    <!--        <label for="inputUsername" class="sr-only">Username: </label>-->
            <input type="text" id="inputUsername" name="username" class="input-user-login" placeholder="Username" required autofocus>

    <!--        <label for="inputPassword" class="sr-only">Password: </label>-->
            <input type="password" id="inputPassword" name="password" class="input-user-login" placeholder="Password" required>

            <button class="btn-basic btn-login" type="submit" name="signIn">Sign in</button>
        </form>
        <form action="userRegister.php" method="post">
            <button class="btn-basic btn-login" type="submit" name="register">Register</button>
        </form>

    </section>
</div>

<?php include 'view/footer.php'; ?>