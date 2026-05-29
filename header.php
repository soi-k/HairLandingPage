<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Hair Evolution Factory — Nowoczesna fabryka przemysłowego farbowania włosów naturalnych. Wrocław, Polska. Współpracujemy wyłącznie w modelu B2B.">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<nav class="navbar" id="navbar">
  <div class="container">
    <div class="nav-inner">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo">
        <span class="nav-logo-text">Hair Evolution <em>Factory</em></span>
      </a>

      <ul class="nav-menu" id="navMenu">
        <li><a href="#about">O Fabryce</a></li>
        <li><a href="#hair-types">Rodzaje Włosów</a></li>
        <li><a href="#calculator">Kalkulator</a></li>
        <li><a href="#why">Dlaczego My</a></li>
        <li><a href="#contact">Kontakt</a></li>
        <li><a href="#calculator" class="nav-cta">Oblicz cenę</a></li>
      </ul>

      <button class="hamburger" id="hamburger" aria-label="Menu">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </div>
</nav>
