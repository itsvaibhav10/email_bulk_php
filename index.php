<?php
session_start();
ob_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
    <link rel="stylesheet" href="asset/css/bootstrap.css">
</head>
<body class="bg-dark">
<div class="container ">
    <div class="row m-3">
        <div class="col-12 bg-light">
            <h3 class="text-center text-primary m-3 font-weight-bold">Heading</h3>
            <hr>
            <?php
            if (isset($_SESSION['error_msg']) AND !empty($_SESSION['error_msg'])){?>
            <p class="alert alert-danger text-center font-weight-bold "><?php echo $_SESSION['error_msg'];?></p>
            <?php
            }
            ?>
            <form class="m-2 " action="mail.php" method="post" enctype="multipart/form-data">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Date:</div>
                    </div>
                    <input type="date" name="date" class="form-control" id="date"
                           value="<?php echo date("Y-m-d"); ?>">
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Subject:</div>
                    </div>
                    <input type="text" name="subject" class="form-control" id="inlineFormInputGroup"
                           placeholder="Subject Here">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="10"></textarea>
                </div>
                <div class="form-group mb-2">
                    <label for="attachment">Attachment Here </label>
                    <input type="file" name="image_upload" class="form-control-file" id="image_upload">
                </div>
                <div class="clearfix">
                    <div class=" btn-group  float-right ">
                        <button type="submit" name="submit_mail" class="btn btn-success mr-2 ">Submit</button>
                        <button type="reset" class="btn btn-danger mr-2 ">Reset</button>
                    </div>
                </div>
            </form>
            <hr>
            <form action="mail.php" class="clearfix " method="post">
                <h3 class="text-center text-primary m-3 font-weight-bold"><--Click The Button Below First--></h3>
                <br>
                <button type="submit" class="btn btn-block btn-dark btn-lg" name="reset_flag">Click Here For Reset</button>
            </form>
            <br>
            <a  href="mailed_table.php" class="btn btn-block btn-success btn-lg" name="mailed_list">Click Here For Emailed List</a>
            <hr>
            <br>
        </div>
    </div>
</div>
</body>
<script src="asset/js/popper.js"></script>
<script src="asset/js/jquery.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
</html>
<?php
session_destroy();
?>

