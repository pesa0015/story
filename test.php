<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="demonstration of some noty capabilities">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/jquery.noty.packaged.min.js"></script>
</head>
<body>

<!--<script src="js/noty_row_inserted.js"></script>-->

<!--<script>function test() { window.location.reload(); }</script>-->

<?php

$error = 0;
$sql_admin = '';
$sql_flexible = '';

if (isset($_POST['admin_yes']) || isset($_POST['admin_no'])) {
    if (isset($_POST['admin_yes']) && isset($_POST['admin_no'])) {
        $error = 1;
    }
    else {
        if (isset($_POST['admin_yes'])) {
            $sql_admin = $_POST['admin_yes'];
        }
        if (isset($_POST['admin_no'])) {
            $sql_admin = $_POST['admin_no'];
        }
    }
}

if (isset($_POST['flexible_yes']) || isset($_POST['flexible_no'])) {
    if (isset($_POST['flexible_yes']) && isset($_POST['flexible_no'])) {
        $error = 1;
    }
    else {
        if (isset($_POST['flexible_yes'])) {
            $sql_flexible = $_POST['flexible_yes'];
        }
        if (isset($_POST['flexible_no'])) {
            $sql_flexible = $_POST['flexible_no'];
        }
    }
}

if ($error == 1) {
    echo 'Error';
}

else {
    echo $sql_admin . ' ' . $sql_flexible;
}

?>

<form action="" method="post">
    <div>
        <div>Vill du vara administratör av den här storyn?</div>
        <input type="checkbox" name="admin_yes" value="Yes"> Ja <input type="checkbox" name="admin_no" value="No"> Nej<br />
    </div>
    <div>
        <div>Ska den här storyn vara flexibel?</div>
        <input type="checkbox" name="flexible_yes" value="Yes"> Ja <input type="checkbox" name="flexible_no" value="No"> Nej<br />
    </div>
    <input type="submit" name="create_table" value="Skapa"><br />
</form>

</body>
</html>