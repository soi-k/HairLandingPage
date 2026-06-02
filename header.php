<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Hair Evolution Factory — Nowoczesna fabryka przemysłowego farbowania włosów naturalnych. Wrocław, Polska. Współpracujemy wyłącznie w modelu B2B.">
  <meta name="robots" content="noindex, nofollow">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<nav class="navbar" id="navbar">
  <div class="container">
    <div class="nav-inner">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo">
        <span class="nav-logo-text"><?php echo esc_html(hair_mod('logo_name','Hair Evolution')); ?> <em><?php echo esc_html(hair_mod('logo_italic','Factory')); ?></em></span>
      </a>

      <ul class="nav-menu" id="navMenu">
        <li><a href="<?php echo esc_url(home_url('/#about')); ?>">O Fabryce</a></li>
        <li><a href="<?php echo esc_url(home_url('/#hair-types')); ?>">Rodzaje Włosów</a></li>
        <li><a href="<?php echo esc_url(home_url('/#why')); ?>">Dlaczego My</a></li>
        <li><a href="<?php echo esc_url(home_url('/#contact')); ?>">Kontakt</a></li>
        <?php
        $nav_btn_url  = hair_mod('hero_btn1_url','') ?: '#about';
        $nav_btn_text = hair_mod('hero_btn1','Aktualności');
        ?>
        <li><a href="<?php echo esc_url($nav_btn_url); ?>" class="nav-cta"><?php echo esc_html($nav_btn_text); ?></a></li>
      </ul>

      <button class="hamburger" id="hamburger" aria-label="Menu">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </div>
</nav>
