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

<section>

    <form class="form-signin" action="userArea.php" method="post">
        <h1>Welcome!</h1>
    
        <label for="inputUsername" class="sr-only">Username: </label>
        <input type="text" id="inputUsername" name="username" class="input-user-resgistration" placeholder="Username" required autofocus>
    
        <label for="inputPassword" class="sr-only">Password: </label>
        <input type="password" id="inputPassword" name="password" class="input-user-resgistration" placeholder="Password" required>
        <br>
        <button class="btn-basic" type="submit" name="signIn">Sign in</button>
    </form>
    <form class="form-signin" action="userRegister.php" method="post">
        <button class="btn-basic" type="submit" name="register">Register</button>
    </form>

</section>

<?php include 'view/footer.php'; ?>