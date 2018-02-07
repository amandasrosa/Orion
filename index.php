<?php
	require_once('model/database.php');
	require_once('model/question_db.php');
	require_once('model/result_db.php');
	require_once('model/subject_db.php');
	require_once('model/user_db.php');
	include 'view/header.php'; 
?>

<section class="text-center">

    <form class="form-signin" action="login.php" method="post">
        <h1 class="h3 mb-3 font-weight-normal">Welcome!</h1>
    
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="email" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
    
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <br>
        <button class="btn btn-primary btn-block" type="submit" name="signIn">Sign in</button>
    </form>
    <form class="form-signin" action="userArea.php" method="post">
        <button class="btn btn-primary btn-block" type="submit" name="register">Register</button>
    </form>

</section>

<?php include 'view/footer.php'; ?>