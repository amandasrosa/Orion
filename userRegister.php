<?php

require_once('model/database.php');
require_once('model/user_db.php');

if (isset($_POST['registerUser'])) {
    $user = getInputData();
    add_user(
        false,
        $user['username'],
        $user['password'],
        $user['firstName'],
        $user['lastName'],
        $user['email'],
        $user['phone'],
        $user['address']);
}

function getInputData() {

    $user = [];
    $user['username'] = filter_input(INPUT_POST, "inputUsername");
    $user['password'] = filter_input(INPUT_POST, "inputPassword");
    $user['firstName'] = filter_input(INPUT_POST, "inputFirstName");
    $user['lastName'] = filter_input(INPUT_POST, "inputLastName");
    $user['email'] = filter_input(INPUT_POST, "inputEmail");
    $user['phone'] = filter_input(INPUT_POST, "inputPhone");
    $user['address'] = filter_input(INPUT_POST, "inputAddress");

    return $user;
}

include 'view/header.php'; ?>

    <section style="margin: 0 auto; width: 50%">
        <form action="userRegister.php" method="post" class="form-group form-user-registration validate">
            <h1 class="center-text">User Registration:</h1>

            <label for="inputUsername" class="label-user-resgistration label-right">Username:</label>
            <input type="text" name="inputUsername" class="input-user-resgistration" placeholder="Username" required
                   autofocus>
            <div class="error-message hidden" id="error-for-inputUsername">Please choose a username.</div>

            <label for="inputPassword" class="label-user-resgistration label-right">Password:</label>
            <input type="password" name="inputPassword" class="input-user-resgistration" placeholder="Password"
                   required >
            <div class="error-message hidden" id="error-for-inputPassword">Please inform a valid password.</div>

            <label for="inputConfirmPassword" class="label-user-resgistration label-right">Confirm Password:</label>
            <input type="password" name="inputConfirmPassword" class="input-user-resgistration" placeholder="Password"
                   required >
            <div class="error-message hidden" id="error-for-inputConfirmPassword">The confirmation must be equal.</div>

            <label for="inputFirstName" class="label-user-resgistration label-right">First Name:</label>
            <input type="text" name="inputFirstName" class="input-user-resgistration" placeholder="First name"
                   required >
            <div class="error-message hidden" id="error-for-inputFirstName">Please inform your firt name.</div>

            <label for="inputLastName" class="label-user-resgistration label-right">Last Name:</label>
            <input type="text" name="inputLastName" class="input-user-resgistration" placeholder="Last name" required >
            <div class="error-message hidden" id="error-for-inputLastName">Please inform your last name.</div>

            <label for="inputEmail" class="label-user-resgistration label-right">Email:</label>
            <input type="email" name="inputEmail" class="input-user-resgistration" placeholder="Email" required >
            <div class="error-message hidden" id="error-for-inputEmail">Please inform a valid email.</div>

            <label for="inputPhone" class="label-user-resgistration label-right">Phone:</label>
            <input type="tel" name="inputPhone" class="input-user-resgistration" placeholder="Phone" required >
            <div class="error-message hidden" id="error-for-inputPhone">Please inform a valid phone number.</div>

            <label for="inputAddress" class="label-user-resgistration label-right">Address</label>
            <input type="tel" name="inputAddress" class="input-user-resgistration"ds placeholder="Address" required>
            <div class="error-message hidden" id="error-for-inputAddress">Please inform your address.</div>

            <input class="btn-basic btn-user-registration" type="submit" value="Register" name="registerUser">
        </form>
    </section>
    <script src="js/formValidation.js"></script>
<?php include 'view/footer.php'; ?>