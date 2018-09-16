<?php
date_default_timezone_set('Asia/Calcutta');
ini_set( 'date.timezone', 'Asia/Calcutta' );
$dt = new DateTime();
$trating_date = $dt->format('Y-m-d');
$trating_time=$dt->format('H:i:s');
$host = 'localhost';
$user = 'username Here';
$pass = 'password here';
$db = 'database name here';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$DB_HOST = 'localhost';
$DB_USER = 'username here';
$DB_PASS = 'password here';
$DB_NAME = 'database name here';
try{
    $DB_con = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USER,$DB_PASS);
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo $e->getMessage();
}
?>
