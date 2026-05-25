<?php
include('db.php');
session_start(); //la session

//Seul l'admin peut supp
if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM montres WHERE id=$id");
}
header("Location: admin.php");
?>