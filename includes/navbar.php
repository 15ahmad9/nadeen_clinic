<nav class="navbar">


<div class="nav-logo">

<a href="index.php">

<img src="assets/images/logo.png" alt="Logo">

</a>

</div>




<div class="nav-language">


<a href="<?=switch_lang_url($lang=='ar'?'en':'ar')?>">

<?=t('language')?>

</a>


</div>

<!-- Mobile Button -->

<div class="menu-toggle" onclick="toggleMenu()">

<span></span>
<span></span>
<span></span>

</div>



<div class="nav-links" id="navLinks">


<a href="index.php">
<?=t('home')?>
</a>


<a href="cases.php">
<?=t('gallery')?>
</a>


<a href="reviews.php">
<?=t('reviews')?>
</a>

<a href="articles.php"><?=t('articles')?></a>

<a href="index.php#services-section">

<?=t('services')?>

</a>

<a href="index.php#location-section">
<?=t('location')?>
</a>


<a href="index.php#location-section">
<?=t('contact')?>
</a>


</div>




</nav>
