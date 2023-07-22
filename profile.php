<?php
$pageTitle = "Home";
require_once("layouts/header.php");
include 'html/profile.html';
session_start();
if (!isset($_SESSION['login'])) {
    header('location: register.php');
    die();
}
?>

