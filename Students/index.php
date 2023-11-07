
<?PHP include '../includes/functions.php';
@session_start();
if (empty($_SESSION['userSession'])) {
    $isAjaxRequest = json_encode(['data' => json_decode(file_get_contents('php://input'), true)]);
    if (isset($isAjaxRequest)) {
        include '../includes/momo_payment_response.php';
        die();
    } else {
        echo '<meta http-equiv="Refresh" content="0; url=../login.php">';
    }
} else {

    $query = $con->query("SELECT * FROM users WHERE id=" . $_SESSION['userSession']) or die(mysqli_error($con));

    while ($userRow = $query->fetch_array()) {

        $email = $userRow['user_email'];
        $level = $userRow['user_level'];
        $full_name = $userRow['full_name'];
        $your_tel = $userRow['tel'];
        $user_id=$userRow['id'];
        $_SESSION['user'] = $userRow;

    }
    $str = $_SESSION['userSession'];

    $your_id = $user_id;
    $select = $con->query("SELECT * FROM   ayear WHERE status='1' ") or die(mysqli_error($con));

    while ($rows = $select->fetch_assoc()) {
        $cur_ayear = $rows['cur_ayear'];
        $start_date = $rows['start_date'];
        $end_date = $rows['end_date'];
		$cur_year_id=$rows['id'];
    }
    $opens = expire($start_date);
     $closes = expire($end_date);

    if (empty($level)) {
        echo '<meta http-equiv="Refresh" content="0; url=../login.php">';

    } else if ($level != 1) {
        echo '<meta http-equiv="Refresh" content="0; url=../login.php">';
    }
    

    if ($level == '1') {
        ?>
        <?php include '../includes/header.php'; ?>
        <?php include '../includes/Student_sidebar.php'; ?>
        <?php include '../includes/Student_content.php'; ?>
        <?php include '../includes/footer.php'; ?>
    <?php }
} ?>
