<?php session_start() ?>
<?php ob_start() ?>
<?php require_once("../includes/db.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title><?= $title_page; ?> || Admin Panel</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="../datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../img/nu-logo.jpg" />
    <script data-search-pseudo-elements defer src="js/all.min.js"></script>
    <script src="js/feather.min.js"></script>
</head>

<body class="nav-fixed">

    <?php
    if (isset($_SESSION['login']) && $_SESSION['user_role'] == 'Admin') {
        //it's ok
    } else {
        header("Location: ../index.php");
    }
    ?>