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

<div class="menu-toggle" onclick="toggleMenu()">
<span></span>
<span></span>
<span></span>
</div>

<div class="nav-links" id="navLinks">

<a href="index.php"><?=t('home')?></a>

<a href="cases.php"><?=t('gallery')?></a>

<a href="reviews.php"><?=t('reviews')?></a>

<div class="nav-dropdown">
<a href="javascript:void(0)" class="dropdown-toggle">
<?=t('services')?>
</a>
<div class="dropdown-menu">
<a href="index.php#services-section"><?=t('orthodontics')?></a>
<a href="index.php#services-section"><?=t('cleaning')?></a>
<a href="index.php#services-section"><?=t('whitening')?></a>
<a href="index.php#services-section"><?=t('crowns')?></a>
<a href="index.php#services-section"><?=t('veneers')?></a>
<a href="index.php#services-section"><?=t('implants')?></a>
<a href="index.php#services-section"><?=t('fillings')?></a>
<a href="index.php#services-section"><?=t('facial_aesthetics')?></a>
<a href="index.php#services-section"><?=t('pediatric')?></a>
</div>
</div>

<a href="index.php#location-section"><?=t('location')?></a>
<a href="index.php#location-section"><?=t('contact')?></a>

</div>

</nav>