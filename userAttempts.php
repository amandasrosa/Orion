<?php
/**
 * Created by PhpStorm.
 * User: dgois
 * Date: 2018-02-20
 * Time: 9:27 PM
 */
require_once('model/database.php');
require_once('model/result_db.php');
require_once('model/user_db.php');

session_start();

$userId = $_SESSION["userId"];
$username = $_SESSION["username"];
$resultsByUser = get_results_by_user($userId);

include 'view/header.php'; ?>
<section class="section-attempts">
    <?php if (count($resultsByUser) > 0) { ?>
    <table class="table-attempts center-me">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Score</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($resultsByUser as $result) { ?>
                <tr>
                    <td><?php echo $result['description'] ?></td>
                    <td><?php echo sprintf('%02d', $result['grade']);?></td>
                    <td><?php echo $result['status'] == 'DONE' ? DateTime::createFromFormat('Y-m-d', $result['testDate']) -> format('d/m/Y'): ' - '; ?></td>
                    <td><?php echo $result['status'] == 'DONE' ? 'Completed' : 'Aborted' ?></td>
                </tr>
            <?php } ?>
        <?php } else {?>
            <p class="center-me">The user did not do any attempt!</p>
        <?php }?>
        </tbody>
    </table>
</section>
<form action="userArea.php" method="get" class="form-attempts">
    <button type="submit" class="btn-basic input-100" name="backUserArea" >Back to Menu</button>
    <input type="hidden" name="username" value="<?php echo $username ?>">
</form>

<?php include 'view/footer.php'; ?>