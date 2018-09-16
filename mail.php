<?php
use PHPMailer\PHPMailer\PHPMailer;
session_start();
ob_start();
include_once 'db.php';
$tsubject = $mysqli->escape_string($_POST['subject']);
//echo '<br>';
$tdate = $mysqli->escape_string($_POST['date']);
//echo '<br>';
$tcontent = $mysqli->escape_string($_POST['content']);

//Resetting Flag Before Mailing
if (isset($_POST['reset_flag'])) {
    $mysqli->query("UPDATE mail SET flag=0 ");
    $mysqli->query("UPDATE receiver SET flag=0 ");
    header('location:index.php');
} else if (isset($_POST['submit_mail'])) {

    //Checking Body And Subject
    if (empty($tcontent) || empty($tsubject)) {
        $_SESSION['error_msg'] = 'Content And Subject Cannot Be Leave Empty';
        header('location:index.php');
    } else {
// PHP FILE UPLOAD SCRIPT
        if (!empty($_FILES['image_upload'])) {
            $errors = array();
            $file_name = $_FILES['image_upload']['name'];
            $file_size = $_FILES['image_upload']['size'];
            $file_tmp = $_FILES['image_upload']['tmp_name'];
            $file_type = $_FILES['image_upload']['type'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            //Checking Extensions
            $expensions = array("jpeg", "jpg", "png", "pdf");

            if (in_array($file_ext, $expensions) === false) {
                $errors[] = "extension not allowed, please choose a JPEG ,PDF or PNG file.";
            }
            //Checking Size
            if ($file_size > 5242880) {
                $errors[] = 'File size must be less than 5 MB';
            }
            //Upload To Path Provided
            $img_name = $tdate;
            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, "asset/images/" . $img_name . '.' . $file_ext);
               // echo "Success";
            } else {
                //echo 'fail';
                print_r($errors);
            }
        }

//Mailing Process Start Here
        //Query For Sender Selecting Email From Mail Tables
        $result_from = $mysqli->query(" SELECT * From mail where flag=0");
        while ($row_from = $result_from->fetch_assoc()) {
            // echo $row_from['email_id'];
            //Query For Receiver Selecting Emails From Receiver Table Limit To 499 Per Head
            $result_to = $mysqli->query("select * from receiver where flag=0 limit 499");
            while ($row_to = $result_to->fetch_assoc()) {
                $row_to['email_id'];

                //PHP Mailing Script

                require './vendor/autoload.php';

                $mail = new PHPMailer;

                $mail->isSMTP();

                $mail->SMTPDebug = 0;

                $mail->Host = 'tls://smtp.gmail.com:587';

                //$mail->Port = 587;

                $mail->SMTPSecure = 'tls';

                $mail->SMTPAuth = true;

                $mail->Username =  $row_from['email_id'];

                $mail->Password = "Password Here";

                $mail->setFrom('no-reply@example.com','example name');

                $mail->addReplyTo('no-reply@example.com');

                $mail->addAddress( $row_to['email_id'],'example name');

                $mail->Subject = "'" . $tsubject . "'";

                $mail->msgHTML("'" . $tcontent . "'");

                $mail->AltBody = 'This is a plain-text message body';

                if (!$mail->send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                } else {
                    echo ' Sent' . $mail->ErrorInfo;
                    echo '<br>';
                    echo $row_to['email_id'] . '<br>';
                    //echo "UPDATE receiver SET flag=1,date='$trating_date' WHERE email_id='" . $row_to['email_id'] . "'" . "<br>";
                    $mysqli->query("UPDATE receiver SET flag=1,date='$trating_date' WHERE email_id='" . $row_to['email_id'] . "'");
                }



                $mail->ClearAddresses();
            }
            //echo "UPDATE mail SET flag=1,date='$trating_date' WHERE email_id='" . $row_from['email_id'] . "'" . '<br>';
            $mysqli->query("update mail set flag=1,date='$trating_date' where email_id='" . $row_from['email_id'] . "'");
        }
        function save_mail($mail)
        {
            //You can change 'Sent Mail' to any other folder or tag
            $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
            //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
            $imapStream = imap_open($path, $mail->Username, $mail->Password);
            $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
            imap_close($imapStream);
            return $result;
        }
        header('location:index.php');
    }
}