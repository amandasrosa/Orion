<?php
session_start();
$userFullName = filter_input(INPUT_GET, 'userFullName');

include 'view/header.php'; ?>
    <div class="parent-user-confirmation">
        <section class="center-section user-confirmation">
            <form action="index.php" method="post" class="center">
                <h1>Hey <?php echo $userFullName?>, you're registered!</h1>
                <h2>Thanks for signing up for an Orion account!</h2>
                <input type="submit" value="Redirect to Login Page" class="btn-basic">
            </form>
        </section>
    </div>
<?php include 'view/footer.php'; ?>