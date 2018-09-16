<?php
session_start();
ob_start();
include_once 'db.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="asset/css/bootstrap.css">
</head>
<body>


<table class="table ">
    <thead class="thead-dark">
    <tr>
        <th> #</th>
        <th>Email-id</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sql = "select * from receiver where flag=1";
    $result = $mysqli->query($sql);

    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['id']?></td>
            <td><?php echo $row['email_id']?></td>
            <td><?php echo $row['date']?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
</body>
<script src="asset/js/popper.js"></script>
<script src="asset/js/jquery.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
</html>
