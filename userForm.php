<?php
session_start();
require_once('model/database.php');
require_once('model/user_db.php');
require_once('util.php');

$user = initUserWithDefaultValues();
$errorMessage = '';

if (isset($_POST['registerUser'])) {
    $user = getInputData();

    if (isValid($user)) {
        $userId = add_user(
            false,
            $user['username'],
            $user['password'],
            $user['firstName'],
            $user['lastName'],
            $user['email'],
            $user['phone'],
            $user['address']);

        if ($userId) {
            $userFullName = $user['firstName'] . " " . $user['lastName'];
            header("Location: http://localhost/orion/userConfirmation.php?userFullName=$userFullName");
            die();
        }
    }
} else if (isset($_POST['editProfile'])) {

    $username = filter_input(INPUT_POST, "username");
    $user = get_user($username);
    $user = normalizeUser($user);

} else if (isset($_POST['saveEditedUser'])) {
    $user = getInputData();
    $updatedRows = update_user(
        $user['userId'],
        false,
        $user['username'],
        $user['password'],
        $user['firstName'],
        $user['lastName'],
        $user['email'],
        $user['phone'],
        $user['address']);

    if ($updatedRows > 0) {
        header("Location: http://localhost/orion/userArea.php?username=$user[username]");
        die();
    }
} else if (isset($_POST['cancelEditProfile'])) {
    $username = filter_input(INPUT_POST, 'editedUsername');
    header("Location: http://localhost/orion/userArea.php?username=$username");
    die();

} else if (isset($_POST['cancelRegister'])) {
    print_r($_POST);
    header("Location: http://localhost/orion");
    die();
}

function initUserWithDefaultValues() {
    $user['username'] = '';
    $user['password'] = '';
    $user['firstName'] = '';
    $user['lastName'] = '';
    $user['email'] = '';
    $user['phone'] = '';
    $user['address'] = '';

    return $user;
}

function getInputData() {
    $user['userId'] = filter_input(INPUT_POST, "userId");
    $username = filter_input(INPUT_POST, "inputUsername");
    $user['username'] = empty($username) ? filter_input(INPUT_POST, "editedUsername") : $username;
    $user['password'] = filter_input(INPUT_POST, "inputPassword");
    $user['firstName'] = filter_input(INPUT_POST, "inputFirstName");
    $user['lastName'] = filter_input(INPUT_POST, "inputLastName");
    $user['email'] = filter_input(INPUT_POST, "inputEmail");
    $user['phone'] = filter_input(INPUT_POST, "inputPhone");
    $user['address'] = filter_input(INPUT_POST, "inputAddress");

    return $user;
}

function isValid($user) {

    return (isValidUserName($user) && isValidUserEmail($user));
}

function isValidUserName($user) {
    $isValid = empty(get_user($user['username']));

    if (!$isValid) {
        global $errorMessage;
        $errorMessage = "Sorry, a user already exist with this username";
    }

    return $isValid;
}

function isValidUserEmail($user) {
    $isValid = empty(get_user_by_email($user['email']));

    if (!$isValid) {
        global $errorMessage;
        $errorMessage = "Sorry, a user already exist with this email";
    }

    return $isValid;
}

function normalizeUser($user) {
    $user['firstName'] = $user['first_name'] ? $user['first_name'] : '';
    $user['lastName'] = $user['last_name'] ? $user['last_name'] : '';
    return $user;
}

include 'view/header.php'; ?>

    <section class="section-form">
        <form action="userForm.php" method="post" class="form-user-registration validate">
            <?php if(isset($_POST['register']) || isset($_POST['registerUser'])) { ?>
                <h1 class="center-text">User Registration:</h1>
            <?php } else if (isset($_POST['editProfile'])) { ?>
                <h1 class="center-text">Edit Profile:</h1>
                <input type="hidden" name="userId" value="<?php echo $user['user_id'] ?>">
                <input type="hidden" name="editedUsername" value="<?php echo $user['username'] ?>">
            <?php } ?>

            <label for="inputUsername" class="label-user-resgistration label-right">Username:</label>
            <input type="text" name="inputUsername" class="input-user-resgistration" <?php echo (isset($_POST['editProfile']) ? 'disabled' : 'enabled') ?> placeholder="Username" required
                   value="<?php echo $user['username'] ?>">
            <div class="error-message hidden" id="error-for-inputUsername">Please choose a username.</div>

            <label for="inputPassword" class="label-user-resgistration label-right">Password:</label>
            <input type="password" name="inputPassword" class="input-user-resgistration" placeholder="Password"
                   required value="<?php echo $user['password'] ?>">
            <div class="error-message hidden" id="error-for-inputPassword">Please inform a valid password.</div>

            <label for="inputConfirmPassword" class="label-user-resgistration label-right">Confirm Password:</label>
            <input type="password" name="inputConfirmPassword" class="input-user-resgistration" placeholder="Password"
                   required value="<?php echo $user['password'] ?>">
            <div class="error-message hidden" id="error-for-inputConfirmPassword">Password does not match the confirm password.</div>

            <label for="inputFirstName" class="label-user-resgistration label-right">First Name:</label>
            <input type="text" name="inputFirstName" class="input-user-resgistration" placeholder="First name"
                   required value="<?php echo $user['firstName'] ?>">
            <div class="error-message hidden" id="error-for-inputFirstName">Please inform your first name.</div>

            <label for="inputLastName" class="label-user-resgistration label-right">Last Name:</label>
            <input type="text" name="inputLastName" class="input-user-resgistration" placeholder="Last name"
                   required value="<?php echo $user['lastName'] ?>">
            <div class="error-message hidden" id="error-for-inputLastName">Please inform your last name.</div>

            <label for="inputEmail" class="label-user-resgistration label-right">Email:</label>
            <input type="email" name="inputEmail" class="input-user-resgistration" placeholder="Email"
                   required value="<?php echo $user['email'] ?>">
            <div class="error-message hidden" id="error-for-inputEmail">Please inform a valid email.</div>

            <label for="inputPhone" class="label-user-resgistration label-right">Phone:</label>
            <input type="tel" name="inputPhone" class="input-user-resgistration" placeholder="Phone"
                   required value="<?php echo $user['phone'] ?>">
            <div class="error-message hidden" id="error-for-inputPhone">Please inform a valid phone number.</div>

            <label for="inputAddress" class="label-user-resgistration label-right">Address</label>
            <input type="text" name="inputAddress" class="input-user-resgistration"ds placeholder="Address"
                   required value="<?php echo $user['address'] ?>">
            <div class="error-message hidden" id="error-for-inputAddress">Please inform your address.</div>

            <section>
                <?php if (!empty($errorMessage)) {
                    showErrorMessage($errorMessage);
                }
                ?>
            </section>

            <section class="user-registration-buttons">

                <?php if(isset($_POST['register']) || isset($_POST['registerUser'])) { ?>
                    <input class="btn-basic btn-user-registration" type="submit" value="Cancel" name="cancelRegister" id="cancel" onclick="event.target.form.classList.remove('validate')">
                    <input class="btn-basic btn-user-registration" type="submit" value="Register" name="registerUser">
                <?php } else if (isset($_POST['editProfile'])) { ?>
                    <input class="btn-basic btn-user-registration" type="submit" value="Cancel" name="cancelEditProfile" id="cancel" onclick="event.target.form.classList.remove('validate')">
                    <input class="btn-basic btn-user-registration" type="submit" value="Save" name="saveEditedUser">
                <?php } ?>
            </section>
        </form>
    </section>
    <script src="js/formValidation.js"></script>
<?php include 'view/footer.php'; ?>