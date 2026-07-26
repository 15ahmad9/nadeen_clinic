<?php

require_once "../includes/language.php";

?>
<aside class="sidebar">


<div class="sidebar-logo">

<img src="../assets/images/logo.png">

<h3>
<?=t('admin_panel')?>
</h3>

</div>



<nav>

<a href="../index.php">
<?=t('home')?>
</a>

<a href="dashboard.php">

<?=t('dashboard')?>

</a>



<a href="gallery.php">

<?=t('gallery')?>

</a>



<a href="reviews.php">

<?=t('reviews')?>

</a>

<a href="articles.php">
<?=t('articles')?>
</a>



<a href="messages.php">

<?=t('messages')?>

</a>



</nav>



<div class="sidebar-bottom">




<a class="logout-btn"
href="logout.php">

<?=t('logout')?>

</a>


</div>



</aside>