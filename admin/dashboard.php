<?php

require "auth.php";
require "../config/database.php";
require_once "../includes/articles_schema.php";

ensure_articles_schema($pdo);



$gallery =
$pdo->query(
"SELECT COUNT(*) FROM gallery"
)->fetchColumn();



$messages =
$pdo->query(
"SELECT COUNT(*) FROM messages"
)->fetchColumn();



$reviews =
$pdo->query(
"SELECT COUNT(*) FROM reviews"
)->fetchColumn();

$articles =
$pdo->query(
"SELECT COUNT(*) FROM articles"
)->fetchColumn();


?>


<!DOCTYPE html>
<html>


<head>
<link rel="icon"
href="../assets/images/logo.png">
<link rel="stylesheet" href="admin.css">

</head>


<body>

<?php include "includes/header.php"; ?>
<?php include "includes/sidebar.php"; ?>


<div class="main">


<div class="topbar">

<h2>
Welcome <?= $_SESSION['admin_username']; ?>
</h2>


</div>



<div class="cards">


<div class="card">

<h3>
Gallery
</h3>

<h1>
<?= $gallery ?>
</h1>

</div>



<div class="card">

<h3>
Messages
</h3>

<h1>
<?= $messages ?>
</h1>

</div>



<div class="card">

<h3>
Reviews
</h3>

<h1>
<?= $reviews ?>
</h1>

</div>


<div class="card">

<h3>
Articles
</h3>

<h1>
<?= $articles ?>
</h1>

</div>

</div>


</div>


</body>

</html>